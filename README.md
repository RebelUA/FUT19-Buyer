# FUT19 Buyer

**A very simple FIFA 19 Autobuyer coded in Laravel**

[FUT19 Buyer](https://github.com/InkedCurtis/FUT19-Buyer) is a simplistic FIFA 19 Autobuyer coded using the Laravel 5 Framework alongside the Backpack package.

This is a fork of (wonderful, give him a star) InkedCurtis work. This is not a supported fork, just something which I use for keep updated all of my bot at once. 
It has something new but does not have all new InkedCurtis private upgrade. 

## What's New

* Telegram Notification for use a channel with sound and one with not. Search how to get BOT TOKEN and CHAT ID. 
* Notification when bot finds too many players. 
* Set auto sell or just save cards in tradepile. Useful for market crashes.
* Set account name for better notification.
* Get list of most used players in a specified SBC. Just go to `YOUR_IP/used?sbc=LINK_TO_SBC_LIST`. For example `http://YOUR_IP/used?sbc=https://www.futbin.com/squad-building-challenges/ALL/544/Layvin%20Kurzawa`.

## Private Repository

As from today 31st October this repository will no longer be maintained; if you want access to the newly maintained private repository with advanced features such as Chemistry Cards, Position Cards, Private Support, Daily Maintenance & lots more you can purchase this for a one time fee of ~~£25 GBP~~ £15 GBP (Black Friday ONLY!)

## Help/Support

You can join the Slack chat via this invitation URL: [Here](https://join.slack.com/t/fut19buyer/shared_invite/enQtNDY1NDcwNjk0MzY4LWUwNjY0YWU0ZGJjZGYzY2MyYWExZTY4Y2MyOGMzM2Q2NGVmYzlkNTIzMjljZGQ5MDRjYWE5MTZiNzY4NGUzNGQ)

## Requirements

* DigitalOcean Account - ($100 in Credit if you register using this link - [DigitalOcean](https://m.do.co/c/96b227b93ca5)
* FIFA 19 WebApp Enabled Account

## Installation

* Create a LAMP Droplet within DigitalOcean (Create Droplet > One-Click Apps -> LAMP on 18.04)
* Login to your server via SSH
* Clone the repository to your server using `git clone https://github.com/RebelUA/FUT19-Buyer.git /var/www/buyer/`
* Navigate to the directory `cd /var/www/buyer/`
* Run the setup script! `sudo bash setup.sh`
* If successful you should see something like the following
```
Migrated:  2018_10_23_142808_add_soft_delete_to_players
Migrating: 2018_10_25_155756_add_tradepile_limit
Migrated:  2018_10_25_155756_add_tradepile_limit
Migrating: 2018_10_25_161033_add_pc_fields_to_players
Migrated:  2018_10_25_161033_add_pc_fields_to_players
Seeding: SettingsTableSeeder
Inserted 8 records.
Database seeding completed successfully.
no crontab for root
```
* Open .ENV and add in last line `TELEGRAM_BOT_TOKEN=YOUR BOT TOKEN ID`
* Go to the server ip created with digitalocean. 
* Create an account and log in. 
* Go to settings and insert your telegram chat id credentials.

## Screenshots

![Screenshot](https://i.imgur.com/4kBLiIp.png)

## More Projects
If you require any projects/systems to be developed by myself that entail anything related to FUT then be sure to contact me using one of the methods below.

Skype: <strong>bws-curtis</strong><br/>
Email: <strong>wscrewey@hotmail.com</strong><br/>
Website: <strong>https://curtiscrewe.co.uk</strong>
