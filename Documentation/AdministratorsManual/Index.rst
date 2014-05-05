.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../Includes.txt


.. _admin-manual:

Administrators Manual
=====================

Installation
------------

Follow these two steps to install the Content Scheduler extension:

1. Using the TYPO3 CMS Extension Manager, download and install the extension (`EXT:cw_content_scheduler`).
2. Profit! :)

Configuration
-------------

The Content Scheduler extension provides a single setting in the Extension Configuration:

Enable Content Scheduler for tt_content
    Enable/disable Content Scheduler for tt_content records (content elements). When enabled, the ``starttime`` and ``endtime`` fields are not used in their default way to determine whether or not a content element should be published. Instead, they are only used in conjunction with the Publication Repeat Interval.

    Default: true (enabled)

.. note::
   
   If you're using Content Scheduler for other records, please make sure that the ``starttime`` and ``endtime`` fields are not used in their default way to determine whether or not a content element should be published. More information: see the :ref:`developers-corner`.