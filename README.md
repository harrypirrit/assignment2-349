# COSC349 Assignment 1

Matt Dixon (5305245)
Harry Pirrit (8715047)

Our application is a simple currency converter to go from NZD to multiple different currencies. It has two views - a User view, and an Admin view.

In the User view - a user can select a currency they would like to convert from 1 NZD -> New currency. They can click convert and this will convert it and produce an output.

In the Admin view - an admin can view live updates of the amount of times a currency has been converted. I.e, A 'currency count' for each.

We use a Vagrant file to boot up and synchronise 3 VMs:
- The User Web Server on port 80 - 'normal' users access and convert $1.00 New Zealand Dollar to multiple different currencies, AUD, USD, GBP, and KRW.
  - the web server accesses the database, and passes a currency argument to the Database server. It displays the selected output. When a currency is converted, the 'tally' for each of the currencies' count values is updated by 1.
- The Admin Server on Port 81 - admin to use to have access to the amount of time each currency has been converted.
  - the admin server accesses the Database through a PDO, and selects the tally values from the Counters(Kounters) table. It displays to the admin how many times a currency has been converted.
- The Database Server(s) accessed through an IP -  is used for storing the user ID and the default currency from the DB view to the Admin and User view. 
  - this stores 2 databases; currencies & kounters - used in the Web view and the Admin view. 
  - we split this into 2 separate databases, and used the name 'kounters' as the table name - as a way to get around naming problems we have.


To run our application:
- Clone the repo into a local directory
- Then type 'vagrant up'
- Once the build has finished, go to http://localhost:8080 to access the converter.


To access the admin view, go to http://localhost:8081
