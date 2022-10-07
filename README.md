# COSC349 Assignment 2

Matt Dixon (5305245)
Harry Pirrit (8715047)

This application is a follow on from our assignment 1 application however, deployed in the cloud via AWS.

You can find Assignment Part 1 Here: https://github.com/harrypirrit/assignment1-349

To deploy our application, you will need to be logged in with our AWS Credentials to access the resources.

---
Our application is a simple currency converter to go from NZD to multiple different currencies. It has two views - a User view, and an Admin view.

In the User view - a user can select a currency they would like to convert from 1 NZD -> New currency. They can click convert and this will convert it and produce an output.

In the Admin view - an admin can view live updates of the amount of times a currency has been converted. I.e, A 'currency count' for each.
---

Important Video Timestamps
0:00 - we navigate from the Instance page to the User (EC2) Instance. Showing the working conversion.

0:26 - we navigate from the Instance page to the Admin (EC2) Instance. This shows that the counter's have been updated, and the connection between them is successful.
