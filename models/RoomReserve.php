<?php

namespace suPnPsu\reserveRoom\models;

use Yii;

/**
 * This is the model class for table "room_reserve".
 *
 * @property integer $id
 * @property integer $room_id
 * @property string $subject
 * @property string $date_start
 * @property string $date_end
 * @property string $time_start
 * @property string $time_end
 * @property integer $status
 * @property integer $user_id
 * @property integer $staff_id
 * @property integer $staff_at
 * @property integer $note
 * @property integer $created_at
 * @property integer $created_by
 * @property integer $updated_at
 * @property integer $updated_by
 */
class RoomReserve extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'room_reserve';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'room_id', 'subject', 'date_start', 'date_end', 'time_start', 'time_end', 'status', 'user_id', 'staff_id', 'staff_at', 'note', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'required'],
            [['id', 'room_id', 'status', 'user_id', 'staff_id', 'staff_at', 'note', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['date_start', 'date_end', 'time_start', 'time_end'], 'safe'],
            [['subject'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'รหัส'),
            'room_id' => Yii::t('app', 'ห้อง'),
            'subject' => Yii::t('app', 'เรื่อง'),
            'date_start' => Yii::t('app', 'ขอใช้ในวัน'),
            'date_end' => Yii::t('app', 'ถึงวันที่'),
            'time_start' => Yii::t('app', 'เริ่มเวลา'),
            'time_end' => Yii::t('app', 'ถึงเวลา'),
            'status' => Yii::t('app', 'Status'),
            'user_id' => Yii::t('app', 'ผู้ยืนขอใช้'),
            'staff_id' => Yii::t('app', 'เจ้าหน้าที่'),
            'staff_at' => Yii::t('app', 'เมื่อ'),
            'note' => Yii::t('app', 'หมายเหตุ'),
            'created_at' => Yii::t('app', 'สร้างเมื่อ'),
            'created_by' => Yii::t('app', 'สร้างโดย'),
            'updated_at' => Yii::t('app', 'ปรับปรุงเมื่อ'),
            'updated_by' => Yii::t('app', 'ปรับปรุงโดย'),
        ];
    }
}
