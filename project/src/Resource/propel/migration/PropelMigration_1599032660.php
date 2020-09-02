<?php

use Propel\Generator\Manager\MigrationManager;

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1599032660.
 * Generated on 2020-09-02 07:44:20 by sms
 */
class PropelMigration_1599032660
{
    public $comment = '';

    public function preUp(MigrationManager $manager)
    {
        // add the pre-migration code here
    }

    public function postUp(MigrationManager $manager)
    {
        // add the post-migration code here
    }

    public function preDown(MigrationManager $manager)
    {
        // add the pre-migration code here
    }

    public function postDown(MigrationManager $manager)
    {
        // add the post-migration code here
    }

    /**
     * Get the SQL statements for the Up migration
     *
     * @return array list of the SQL strings to execute for the Up migration
     *               the keys being the datasources
     */
    public function getUpSQL()
    {
        return array (
            'sms' => '
BEGIN;

CREATE TABLE IF NOT EXISTS "sms_blacklist"
(
    "id" serial NOT NULL,
    "phone" VARCHAR(255) NOT NULL,
    "created_at" TIMESTAMP,
    PRIMARY KEY ("id"),
    CONSTRAINT "sms_blacklist_u_41ae38" UNIQUE ("phone")
);

COMMIT;
',
        );
    }

    /**
     * Get the SQL statements for the Down migration
     *
     * @return array list of the SQL strings to execute for the Down migration
     *               the keys being the datasources
     */
    public function getDownSQL()
    {
        return array (
            'sms' => '
BEGIN;

DROP TABLE IF EXISTS "sms_blacklist" CASCADE;

COMMIT;
',
        );
    }

}
