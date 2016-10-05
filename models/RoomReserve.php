<?php

namespace suPnPsu\reserveRoom\models;

use Yii;
use yii\helpers\ArrayHelper;
use suPnPsu\room\models\Room;
use suPnPsu\user\models\User;
use suPnPsu\borrowMaterial\models\StdBelongto;
use suPnPsu\borrowMaterial\models\StdPosition;
use yii\helpers\Html;

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
class RoomReserve extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'room_reserve';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
                [['room_id', 'subject', 'date_start', 'time_start', 'time_end'], 'required'],
                [['room_id', 'status', 'user_id', 'confirmed_status','confirmed_by', 'confirmed_at', 'returned_status','returned_by', 'returned_at', 'note', 'created_at', 'created_by', 'updated_at', 'updated_by', 'sent_at'], 'integer'],
                [['date_start', 'date_end', 'time_start', 'time_end'], 'safe'],
                [['confirmed_comment', 'returned_comment'], 'string'],
                [['subject'], 'string', 'max' => 255],
                [['room_id'], 'exist', 'skipOnError' => true, 'targetClass' => Room::className(), 'targetAttribute' => ['room_id' => 'id']],
                [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
                [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
                [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
                [['belongto_id'], 'exist', 'skipOnError' => true, 'targetClass' => StdBelongto::className(), 'targetAttribute' => ['belongto_id' => 'id']],
                [['position_id'], 'exist', 'skipOnError' => true, 'targetClass' => StdPosition::className(), 'targetAttribute' => ['position_id' => 'id']],
                [['confirmed_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['confirmed_by' => 'id']],
                [['returned_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['returned_by' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
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
            'belongto_id' => Yii::t('app', 'สังกัดองค์กร'),
            'position_id' => Yii::t('app', 'ตำแหน่ง'),
            'sent_at' => Yii::t('app', 'ส่งเมื่อ'),
            'confirmed_status'=>Yii::t('app', 'พิจารณาการขอใช้ห้อง'),
            'confirmed_comment' => Yii::t('app', 'ความคิดเห็น/เพราะสาเหตุ'),
            'confirmed_by' => Yii::t('app', 'อนุมัติโดย'),
            'confirmed_at' => Yii::t('app', 'อนุมัติเมื่อ'),
            'returned_status'=>Yii::t('app', 'คืนห้อง'),
            'returned_comment' => Yii::t('app', 'ความคิดเห็น/ปัญหา'),
            'returned_by' => Yii::t('app', 'รับคืนโดย'),
            'returned_at' => Yii::t('app', 'รับคืนเมื่อ'),
            'note' => Yii::t('app', 'หมายเหตุ'),
            'created_at' => Yii::t('app', 'สร้างเมื่อ'),
            'created_by' => Yii::t('app', 'สร้างโดย'),
            'updated_at' => Yii::t('app', 'ปรับปรุงเมื่อ'),
            'updated_by' => Yii::t('app', 'ปรับปรุงโดย'),
            'time_range' => Yii::t('app', 'ช่วงเวลา'),
            'date_range' => Yii::t('app', 'ช่วงเวลาที่ขอใช้'),
            
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoom() {
        return $this->hasOne(Room::className(), ['id' => 'room_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy() {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy() {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser() {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConfirmedBy() {
        return $this->hasOne(User::className(), ['id' => 'confirmed_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReturnedBy() {
        return $this->hasOne(User::className(), ['id' => 'returned_by']);
    }

    ###########################################

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBelongto() {
        return $this->hasOne(StdBelongto::className(), ['id' => 'belongto_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosition() {
        return $this->hasOne(StdPosition::className(), ['id' => 'position_id']);
    }

    public $date_range;

    public static function itemsAlias($key) {
        $items = [
            'status' => [
                0 => Yii::t('app', 'ร่าง'),
                1 => Yii::t('app', 'เสนอ'),
                2 => Yii::t('app', 'อนุมัติ'),
                3 => Yii::t('app', 'ไม่อนุมัติ'),
                4 => Yii::t('app', 'คืนแล้ว'),
            ],
            'statusCondition'=>[
                1 => Yii::t('app', 'อนุมัติ'),
                0 => Yii::t('app', 'ไม่อนุมัติ'),
            ]
        ];
        return ArrayHelper::getValue($items, $key, []);
    }

    public function getStatusLabel() {
        $status = ArrayHelper::getValue($this->getItemStatus(), $this->status);
        $status = ($this->status === NULL) ? ArrayHelper::getValue($this->getItemStatus(), 0) : $status;
        switch ($this->status) {
            case 0 :
            case NULL :
                $str = '<span class="label label-warning">' . $status . '</span>';
                break;
            case 1 :
                $str = '<span class="label label-primary">' . $status . '</span>';
                break;
            case 2 :
                $str = '<span class="label label-success">' . $status . '</span>';
                break;
            case 3 :
                $str = '<span class="label label-danger">' . $status . '</span>';
                break;
            case 4 :
                $str = '<span class="label label-succes">' . $status . '</span>';
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
    
    public static function getItemStatusConsider() {
        return self::itemsAlias('statusCondition');       
    }

    public function getTimeRange() {
        return Yii::$app->formatter->asTime($this->time_start) . ' - ' . Yii::$app->formatter->asTime($this->time_end);
    }

    public function getDateRange() {
        return Yii::$app->formatter->asDate($this->date_start) . '<br/>' . Html::tag('small', '<i class="fa fa-clock-o"></i> ' . Yii::$app->formatter->asTime($this->time_start) . ' - ' . Yii::$app->formatter->asTime($this->time_end) . Yii::t('app', 'น.'));
    }

    public static function findUse() {
        return self::find()
                        ->where(['status' => [2, 4]])
                        ->all();
    }

    public static function getActivity() {
        $activity = static::findUse();
        $events = array();
        foreach ($activity as $act) {
            $Event = new \yii2fullcalendar\models\Event();
            $Event->id = $act->id;
            $Event->title = $act->room->title . " เรื่อง:" . $act->subject . " ขอใช้โดย​:" . $act->createdBy->username;
            $Event->backgroundColor = $act->room->stylies->backgroundColor;
            $Event->textColor = $act->room->stylies->textColor;
            $Event->borderColor = $act->room->stylies->borderColor;
            //date('Y-m-d\TH:i:s\Z',strtotime($time->date_start.' '.$time->time_start));
            $Event->start = date('Y-m-d\TH:i:s\Z', strtotime($act->date_start . ' ' . $act->time_start));
            $Event->end = date('Y-m-d\TH:i:s\Z', strtotime($act->date_start . ' ' . $act->time_end));
            $Event->editable = false;
            $Event->allDay = false;
            $Event->durationEditable = false;
            $Event->startEditable = false;
            $events[] = $Event;
            
        }
        return $events;
    }
    
    
    

}
