<?php
use Illuminate\Support\Facades\DB;
$sbcs = DB::table('sbc')->orderBy('id', 'desc')->get(); ?>
@extends('backpack::layout')
@section('header')
    <section class="content-header">
        <?php if(!isset($_GET['buyList'])){ ?>
        <h1>
            SBC
            <small>Find most used player in SBC</small>
        </h1>
        <?php } else { ?>
        <h1>
            SBC
            <small>Buy automatically a list of player</small>
        </h1>
        <?php } ?>
    </section>
@endsection
@section('content')
    <?php if(!isset($_GET['buyList'])){ ?>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-body">
                    <?php if(!isset($_GET['sbc'])){ ?>
                    <form action="/used" method="GET">
                        <div class="form-group">
                            <label for="url">Enter the SBC URL</label>
                            <input class="form-control" type="url" name="sbc" id="url" aria-describedby="sbc-help">
                            <small id="sbc-help" class="form-text text-muted">The sbc url can be obtained by choosing
                                <code>Completed Challenge</code> <a
                                    href="https://www.futbin.com/squad-building-challenges" target="_blank">at this
                                    link.</a></small>
                        </div>
                        <button type="submit" class="btn btn-primary">Find</button>
                    </form>
                    <?php } else {
                    $solution_url = $_GET['sbc'];
                    $players_list = [];
                    $doc = hQuery::fromUrl($solution_url);
                    $url_list = $doc->find('a.squad_url');
                    if ($url_list) {
                        foreach ($url_list as $url) {
                            $url = $url->attr('href');
                            $doc = hQuery::fromUrl($url);
                            $players = $doc->find('div.card > .cardetails > a');
                            foreach ($players as $pos => $a) {
                                $player_card = $a->find('div')[0];
                                $player_id = $player_card->attr('data-player-id');
                                $count = 1;
                                if (array_key_exists($player_id, $players_list)) {
                                    $count = $players_list[$player_id]['count'] + 1;
                                }
                                $players_list[$player_card->attr('data-player-id')] = [
                                    'name' => $player_card->attr('data-player-commom'),
                                    'count' => $count,
                                    'rating' => $player_card->attr('data-rating'),
                                    'price' => $player_card->attr('data-price-ps3')
                                ];
                            };
                        };
                    }
                    if (count($players_list) > 1) {
                        $count = array();
                        $rate = array();
                        foreach ($players_list as $key => $player) {
                            $count[] = $player['count'];
                            $rate[] = $player['rating'];
                            $price[] = $player['price'];
                        }
                    }
                    // now apply sort
                    array_multisort($count, SORT_DESC, SORT_NUMERIC, $rate, SORT_DESC, $players_list); ?>
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Soluzioni</th>
                            <th>Overrall</th>
                            <th>Costo</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($players_list as $player) { ?>
                        <tr>
                            <td><?php echo $player['name']; ?></td>
                            <td><?php echo $player['count']; ?></td>
                            <td><?php echo $player['rating']; ?></td>
                            <td><?php echo $player['price']; ?></td>
                        </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <?php } else { ?>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-body">
                    <form action="/sbcpurchaser" id="sbc-purchaser" method="GET" onsubmit="return lifeSaver()">
                        <div class="form-group">
                            <label for="url">Enter the URL of the SBC team (Futbin)</label>
                            <input required class="form-control" type="url" name="buyList" id="url"
                                   aria-describedby="sbc-help">
                        </div>
                        <div class="form-group">
                            <input style="margin-right: 10px" type="checkbox" class="form-check-input"
                                   name="percentages" aria-describedby="percentages-help"><label for="percentages">Would
                                you like to use the same purchase percentages set in the bot?</label>
                            <br/>
                            <small id="percentages-help">By checking this option you will make the purchase of players
                                longer, but you could make it more profitable. Basically, the bot acquits players at a
                                futbol or lower price.
                            </small>
                        </div>
                        <div class="form-group">
                            <label for="increment-by">Would you like to increase the maximum price for each failed
                                offer?</label>
                            <input name="incrementOffer" step="50" class="form-control" type="number" value="0"
                                   id="increment-by" aria-describedby="increment-help">
                            <small id="increment-help">The bot will add the value set here to the FUTBIN price. It can
                                be useful when an SBC of bronze players is made.
                            </small>
                        </div>
                        <button id="submit-button" type="submit" class="btn btn-primary">Find</button>
                        <script type="text/javascript">
                            function lifeSaver() {
                                return confirm("CAUTION. Searching for players via SBC can not be stopped. Are you sure you want to start the action?");
                            }
                        </script>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-body">
                    <h3>SBC completed</h3>
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Shopping</th>
                            <th>Team</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($sbcs as $sbc) { $class = ''; ?>
                        <?php $repeatUrl = '/sbcpurchaser?buyList=' . $sbc->url . '&percentages=' . $sbc->percentages . '&incrementOffer=' . $sbc->incrementBy; ?>
                        <?php if ($sbc->bought == $sbc->squadCount) $class = 'table-success'; ?>
                        <tr class="<?php echo $class; ?>">
                            <td><a target="_blank" href="<?php echo $sbc->url; ?>"><?php echo $sbc->name; ?></a></td>
                            <td><?php echo $sbc->bought; ?></td>
                            <td><?php echo $sbc->squadCount; ?></td>
                            <td><a class="btn btn-primary" href="<?php echo $repeatUrl; ?>" role="button">Repeat</a>
                            </td>
                        </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                    <style media="screen">
                        .table > tbody > tr > td {
                            vertical-align: middle;
                        }
                    </style>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
@endsection
