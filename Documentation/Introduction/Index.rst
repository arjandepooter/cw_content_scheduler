.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../Includes.txt


What does it do?
================

The Content Scheduler (``EXT:cw_content_scheduler``) extension provides an easy way to publish your content on a repeating schedule. By applying a Publication Repeat Interval to a content element, the content element gets repeatedly published and unpublished.

Time for an Example
-------------------

Imagine you're working for a broadcasting company and your TV-show is aired every Wednesday evening from 20:00h to 20:25h. Yep, you're working for a prime time TV-show! You'd love to have a banner linking to the live stream, on a primary position on the homepage. But the banner should only be shown during the broadcasts on Wednesday evenings! There's no point in linking to an offline live stream, right?

Quickly you edit the content element which holds the banner and open the *Access* tab. Like you're used to, you schedule the publication of the content element:

* Publish Date: 20:00 6-5-2014
* Expiration Date: 20:25 6-5-2014

You're all set for next Wednesday. But still, it's cumbersome to repeat this manual process for each and every Wednesday! Luckily, you have the Content Scheduler extension installed and now it's a breeze to accomplish this.

Right there on the *Access* tab two fields are available, conveniently labeled: **Publication Repeat Interval**. The input field takes a numeric value and the accompanying dropdown lets you select the repeat unit. Quickly you enter "1" in the input field and select "weeks" from the dropdown. You hit *Save* and you're done!

The content element will be published every Wednesday from 20:00h to 20:25h. You go home and grab a beer (or wine or coffee, if that's more of your liking).