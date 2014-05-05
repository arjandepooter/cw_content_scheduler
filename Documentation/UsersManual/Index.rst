.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../Includes.txt


.. _users-manual:

Users Manual
============

The Content Scheduler extension adds a **Publication Repeat Interval** field to the *Access* tab of a content element. Here you specify the repeat interval for the publication of the content element. The repeat interval consists of two parts:

1. The repeat interval value (e.g. "2")
2. The repeat interval unit: `minutes, hours, days, weeks` (e.g. "weeks")

The above example results in "2 weeks", so the content element will be published every two weeks.

Usage Examples
--------------

How does Content Scheduler know *when* to publish the content element? Content Scheduler uses the Publish Date and Expiration Date fields of the content element, available by default in TYPO3 CMS, to determine when to publish the content element. Based on the specified interval, the math is like this:

1. **Publish Date** is used to determine the publication *day and time*. For example: if Publish Date is set to "20:00 6-5-2014" and Publication Repeat Interval to "3 days", the content element will be published on 6-5-2014 20:00h, 9-5-2014 20:00h, 12-5-2014 20:00h etc.
2. **Expiration Date** is used to determine the publication *duration*. For example: if Publish Date is set to "20:00 6-5-2014", Expiration Date is set to "20:25 6-5-2014" and Publication Repeat Interval to "3 days", the content element will be published from 6-5-2014 20:00h - 20:25h, 9-5-2014 20:00h - 20:25h, 12-5-2014 20:00h - 20:25h etc.

Some more examples:

==============  ===============  ===========================  =======================================================================
Publish Date    Expiration Date  Publication Repeat Interval  Content element is published
==============  ===============  ===========================  =======================================================================
20:00 6-5-2014  20:25 6-5-2014   2 days                       | 20:00-20:25 6-5-2014
                                                              | 20:00-20:25 8-5-2014
                                                              | 20:00-20:25 10-5-2014
                                                              | etc.
20:00 6-5-2014  8:00  7-5-2014   1 weeks                      | 20:00 6-5-2014 - 8:00 7-5-2014
                                                              | 20:00 13-5-2014 - 8:00 14-5-2014
                                                              | etc.
13:00 6-5-2014  13:05 6-5-2014   4 hours                      | 13:00-13:05 6-5-2014
                                                              | 17:00-17:05 6-5-2014
                                                              | 21:00-21:05 6-5-2014
                                                              | etc.
==============  ===============  ===========================  =======================================================================

Caveats
-------

As nothing is perfect, there are a few caveats to using this extension:

**Page cache lifetime should be smaller than the Publication Repeat Interval**

Be sure to set the page cache lifetime to some value **smaller** than the Publication Repeat Interval. Otherwise, the page is still cached when the content element should be published. There is no way Content Scheduler can invalidate the cache for this page, unfortunately.

**Publication duration should be smaller than the Publication Repeat Interval**

Be sure to make the publication duration (Expiration Date - Publish Date) **smaller** than the Publication Repeat Interval. Otherwise, the content element would never get unpublished, since the publication hasn't finished before the next publication kicks in.

**Limited repeat schedules**

We would love to be able to publish a content element 'every weekday' or 'every Tuesday and Thursday'. But, because of the limitations of the TYPO3 CMS Core in this regard, this is not possible. :(
