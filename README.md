# Content Scheduler

The Content Scheduler (`EXT:cw_content_scheduler`) extension provides an easy way to publish your content on a repeating schedule. By applying a repeat interval to a content element, the content element gets repeatedly published and unpublished, based on the repeat interval.

Right, time for an example: Imagine you're working for a broadcasting company and your TV-show is aired every Wednesday evening from 20:00h to 20:25h. Yep, you're working for a prime time TV-show! You'd love to have a banner linking to the live stream, on a primary position on the homepage. But the banner should only be shown during the broadcasts on Wednesday evenings! There's no point in linking to an offline live stream, right?

Quickly you edit the content element which holds the banner and open the *Access* tab. Like you're used to, you schedule the publication of the content element:

* Publish Date: 20:00 6-5-2014
* Expiration Date: 20:25 6-5-2014

You're all set for next Wednesday. But still, it's cumbersome to repeat this manual process for each and every Wednesday! Luckily, you have the Content Scheduler extension installed and it's a breeze to accomplish this.

Right on the *Access* tab there are two fields added, conveniently labeled: **Publication Repeat Interval**. The input field takes a numeric value and the accompanying dropdown lets you select the repeat unit. Quickly you enter "1" in the input field and select "weeks" from the dropdown. You hit save and you're done!

The content element will be published every Wednesday from 20:00h to 20:25h.

## Installation

Follow these two steps to install the Content Scheduler extension:

1. Using the TYPO3 CMS Extension Manager, download and install the extension (`EXT:cw_content_scheduler`).
2. Profit! :)

## Usage

The Content Scheduler extension adds a **Publication Repeat Interval** field to the Access tab of a content element. Here you specify the repeat interval for the publication of the content element. The repeat interval consists of two parts:

1. The repeat interval value (e.g. "2")
2. The repeat interval unit: `minutes, hours, days, weeks` (e.g. "weeks")

The above example results in "2 weeks", so the content element will be published every two weeks.

How does Content Scheduler know *when* to publish the content element? Glad you asked! Content Scheduler uses the Publish Date and Expiration Date fields of the content element, available by default in TYPO3 CMS, to determine when to publish the content element. Based on the specified interval, the math is like this:

1. Publish Date is used to determine the publication *day and time*. For example: if Publish Date is set to "20:00 6-5-2014" and Publication Repeat Interval to "3 days", the content element will be published on 6-5-2014 20:00h, 9-5-2014 20:00h, 12-5-2014 20:00h etc.
2. Expiration Date is used to determine the publication *duration*. For example: if Publish Date is set to "20:00 6-5-2014", Expiration Date is set to "20:25 6-5-2014" and Publication Repeat Interval to "3 days", the content element will be published from 6-5-2014 20:00h - 20:25h, 9-5-2014 20:00h - 20:25h, 12-5-2014 20:00h - 20:25h etc.

Some more examples:

| Publish Date   | Expiration Date | Publication Repeat Interval | Content element is published                                            |
| -------------- | --------------- | --------------------------- | ----------------------------------------------------------------------- |
| 20:00 6-5-2014 | 20:25 6-5-2014  | 2 days                      | 20:00-20:25 6-5-2014, 20:00-20:25 8-5-2014, 20:00-20:25 10-5-2014, etc. |
| 20:00 6-5-2014 | 8:00  7-5-2014  | 1 weeks                     | 20:00 6-5-2014 - 8:00 7-5-2014, 20:00 13-5-2014 - 8:00 14-5-2014, etc.  |
| 13:00 6-5-2014 | 13:05 6-5-2014  | 4 hours                     | 13:00-13:05 6-5-2014, 17:00-17:05 6-5-2014, 21:00-21:05 6-5-2014, etc.  |

## Caveats

As nothing is perfect, there are a few caveats to using this extension:

**Page cache lifetime**

Be sure to set the page cache lifetime to some value **lower** than the Publication Repeat Interval. Otherwise, the page is still cached when the content element should be published. There is no way Content Scheduler can invalidate the cache for this page, unfortunately.

**Publication duration should be smaller than the Publication Repeat Interval**

Be sure to make the publication duration (Expiration Date - Publish Date) **smaller** than the Publication Repeat Interval. Otherwise, the content element would never get unpublished, since the publication hasn't finished before the next publication kicks in.

**Limited repeat schedules**

We would love to be able to publish a content element 'every weekday' or 'every Tuesday and Thursday'. But, because of the limitations of the TYPO3 CMS Core in this regard, this is not possible. :(