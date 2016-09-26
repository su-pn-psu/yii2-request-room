<?php

namespace suPnPsu\reserveRoom\models;

use Yii;
use yii\helpers\ArrayHelper;
use suPnPsu\room\models\Room;
use suPnPsu\user\models\User;

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
 * @property string $confirmed_comment
 * @property integer $confirmed_by
 * @property integer $confirmed_at
 * @property string $returned_comment
 * @property integer $returned_by
 * @property integer $returned_at
 * @property integer $note
 * @property integer $created_at
 * @property integer $created_by
 * @property integer $updated_at
 * @property integer $updated_by
 *
 * @property Room $room
 * @property User $createdBy
 * @property User $updatedBy
 * @property User $user
 * @property User $confirmedBy
 * @property User $returnedBy
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
            [['room_id', 'subject', 'date_start', 'time_start', 'time_end' ], 'required'],
            [['room_id', 'status', 'user_id', 'confirmed_by', 'confirmed_at', 'returned_by', 'returned_at', 'note', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['date_start', 'date_end', 'time_start', 'time_end'], 'safe'],
            [['confirmed_comment', 'returned_comment'], 'string'],
            [['subject'], 'string', 'max' => 255],
            [['room_id'], 'exist', 'skipOnError' => true, 'targetClass' => Room::className(), 'targetAttribute' => ['room_id' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['confirmed_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['confirmed_by' => 'id']],
            [['returned_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['returned_by' => 'id']],
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
            'date_start' => Yii::t('app', 'ในวันที่'),
            'date_end' => Yii::t('app', 'ถึงวันที่'),
            'time_start' => Yii::t('app', 'เริ่มเวลา'),
            'time_end' => Yii::t('app', 'ถึงเวลา'),
            'status' => Yii::t('app', 'สถานะ'),
            'user_id' => Yii::t('app', 'ผู้ยืนขอใช้'),
            'confirmed_comment' => Yii::t('app', 'Confirmed Comment'),
            'confirmed_by' => Yii::t('app', 'อนุมัติโดย'),
            'confirmed_at' => Yii::t('app', 'อนุมัติเมื่อ'),
            'returned_comment' => Yii::t('app', 'Returned Comment'),
            'returned_by' => Yii::t('app', 'Returned By'),
            'returned_at' => Yii::t('app', 'Returned At'),
            'note' => Yii::t('app', 'หมายเหตุ'),
            'created_at' => Yii::t('app', 'สร้างเมื่อ'),
            'created_by' => Yii::t('app', 'สร้างโดย'),
            'updated_at' => Yii::t('app', 'ปรับปรุงเมื่อ'),
            'updated_by' => Yii::t('app', 'ปรับปรุงโดย'),
            'time_range' => Yii::t('app', 'ช่วงเวลา'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoom()
    {
        return $this->hasOne(Room::className(), ['id' => 'room_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConfirmedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'confirmed_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReturnedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'returned_by']);
    }
    
    ###########################################
    
    public static function itemsAlias($key) {
        $items = [
            'status' => [
                0 => Yii::t('app', 'ร่าง'),
                1 => Yii::t('app', 'เสนอ'),
                2 => Yii::t('app', 'อนุมัติ'),
                3 => Yii::t('app', 'ไม่อนุมัติ'),
                4 => Yii::t('app', 'คืนแล้ว'),
            ],
            'condition' => [
                1 => 'ตัวแทนขอสมัคร',
                2 => 'บริษัทฯจะจ่ายผลตอบแทน',
            ]
        ];
        return ArrayHelper::getValue($items, $key, []);
    }

    public function getStatusLabel() {
        $status = ArrayHelper::getValue($this->getItemStatus(), $this->status);
        $status = ($this->status === NULL) ? ArrayHelper::getValue($this->getItemStatus(), 0) : $status;
        switch ($this->status) {
            case '0' :
            case NULL :
                $str = '<span class="label label-warning">' . $status . '</span>';
                break;
            case '1' :
                $str = '<span class="label label-primary">' . $status . '</span>';
                break;
            case '2' :
                $str = '<span class="label label-success">' . $status . '</span>';
                break;
            default :
                $str = $status;
                break;
        }

        return $str;
    }

    public static function getItemStatus() {
        return self::itemsAlias('status');
    }

    
    public function getTimeRange(){
        return Yii::$app->formatter->asTime($this->time_start) .' - '. Yii::$app->formatter->asTime($this->time_end) ;
        
    }
    
    
    public static function getActivity()
    {
        $activity = self::find()
                //->where(['status'=>1])
                ->all();
        $events = array();
        foreach ($activity as $act) {
            $Event = new \yii2fullcalendar\models\Event();
            $Event->id = $act->id;
            $Event->title = $act->title;
            //$Event->color = $act->calendar->color;
            $Event->start = Yii::$app->formatter->asDate($act->date_start, 'php:Y-m-d');
            $Event->end = Yii::$app->formatter->asDate($act->date_start, 'php:Y-m-d');
            $Event->editable = false;
            $Event->allDay = true ;
            $Event->durationEditable = false;
            $Event->startEditable = false;
            $events[] = $Event;
        }
        return $events;
    }
}
