.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../Includes.txt


.. _developers-corner:

Developers Corner
=================

How does Content Scheduler work?
--------------------------------

Content Scheduler makes use of the ``addEnableColumns`` hook in the PageRepository's ``enableFields`` function. The ``enabledFields`` function checks a number of fields to filter out records that should not be available on the front-end. It checks fields like ``starttime``, ``endtime`` and ``fe_group`` to alter the ``WHERE`` clause of the ``SELECT`` query.

Content Scheduler adds an extra check to the ``WHERE`` clause, taking the Publication Repeat Interval into account. The meat of this check is in the ``EXT:cw_content_scheduler/Resources/Private/Queries/ScheduledQuery.sql`` file: the query template for the check.

.. note::
   When the ``apply_to_ttcontent`` setting is ``TRUE``, the default ``starttime`` and ``endtime`` check is disabled for ``tt_content``. This means that ``starttime`` and ``endtime`` aren't evaluated in enableFields.

   This setting can be found in the Extension Configuration in the Extension Manager.

Content Scheduler for Extensions
--------------------------------

Imagine a plugin showing 5 selected banners (e.g. Extbase model). One or more banners should be published repeatedly. You can use Content Scheduler for that.

If you want to add the Publication Repeat Interval to your own extension, there are a couple of steps to be taken:

1. Add Content Scheduler fields
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Add the Publication Repeat Interval fields to your model, for example:

.. code-block:: sql

    -- In ext_tables.sql
    CREATE TABLE tx_myext_domain_model_mymodel (
        schedule_type varchar(255) DEFAULT '' NOT NULL,
        schedule_amount int(11) DEFAULT '0' NOT NULL
    );

2. Change TCA
^^^^^^^^^^^^^

First, you have to unset the ``starttime`` and ``endtime`` fields from the ``enablecolumns`` array (this makes sure they aren't evaluated as enableFields themselves):

.. code-block:: php

    // In ext_tables.php
    unset($GLOBALS['TCA']['tx_myext_domain_model_mymodel']['ctrl']['enablecolumns']['starttime']);
    unset($GLOBALS['TCA']['tx_myext_domain_model_mymodel']['ctrl']['enablecolumns']['endtime']);

Then, you have to add the Publication Repeat Interval fields:

.. code-block:: php

    // In ext_tables.php
    t3lib_extMgm::addTCAcolumns('tx_myext_domain_model_mymodel', array(
        'schedule_amount' => array(
            'label' => 'Publication Repeat Interval (value)',
            'config' => array(
                'type' => 'input',
                'eval' => 'int',
            ),
        ),
        'schedule_type' => array(
            'label' => 'Publication Repeat Interval (unit)',
            'config' => array(
                'type' => 'select',
                'default' => '',
                'items' => array(
                    array('-------', ''),
                    array('minutes', 'm'),
                    array('hours', 'h'),
                    array('days', 'd'),
                    array('weeks', 'w'),
                ),
            ),
        ),
    ), TRUE);
    t3lib_extMgm::addToAllTCAtypes('tx_myext_domain_model_mymodel', 'schedule_amount,schedule_type', '', 'after:endtime');

Finally, you have to make sure the ``['ctrl']['enablecolumns']['scheduled']`` array for your model is filled with the right fields:

.. code-block:: php

    // In ext_tables.php
    $GLOBALS['TCA']['tx_myext_domain_model_mymodel']['ctrl']['enablecolumns']['scheduled'] = 'starttime,endtime,schedule_amount,schedule_type';
