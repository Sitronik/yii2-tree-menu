<?php

use yii\db\Migration;

class m170626_175738_tree_menu extends Migration
{
    public function up()
    {
        $this->createTable('tree_menu', [
            'id' => $this->primaryKey(),
            'name'      => $this->string(500),
            'url'      => $this->string(500),
            'parent'  => $this->integer(1),
            'parent_id'  => $this->integer(1)
         ]);

        $this->insertData();
    }

    public function insertData() {
        $arr = [
            [
                'name' => 'WorkLoad', 'parent' => 1, 'parent_id' => 0
            ],
            [
                'name' => 'DME Report', 'parent' => 0, 'parent_id' => 1
            ],
            [
                'name' => 'CAMB Report', 'parent' => 0, 'parent_id' => 1
            ],
            [
                'name' => 'LMAB Report', 'parent' => 0, 'parent_id' => 5
            ],
            [
                'name' => 'Condition', 'parent' => 1, 'parent_id' => 3
            ],
            [
                'name' => 'DMF Notification', 'parent' => 0, 'parent_id' => 8
            ],
            [
                'name' => 'LME Forecast Report', 'parent' => 0, 'parent_id' => 8
            ],
            [
                'name' => 'Performance', 'parent' => 1, 'parent_id' => 0
            ],
            [
                'name' => 'Calendar', 'parent' => 1, 'parent_id' => 0
            ],
            [
                'name' => 'Efficiency', 'parent' => 0, 'parent_id' => 9
            ],
            [
                'name' => 'Process Age', 'parent' => 1, 'parent_id' => 5
            ],
            [
                'name' => 'DME Audit', 'parent' => 0, 'parent_id' => 11
            ],
            [
                'name' => 'New1', 'parent' => 0, 'parent_id' => 9
            ]
        ];

        foreach ($arr as $a) {
            $this->insert('tree_menu', [
                'name'      => $a['name'],
                'url'      => '#'.$a['name'],
                'parent'  => $a['parent'],
                'parent_id'  => $a['parent_id']
            ]);
        }
    }

    public function down()
    {
        $this->dropTable('tree_menu');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
