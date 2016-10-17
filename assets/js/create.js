/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var date_start;
var time_start;
var time_end;
var notbalance = false;

$(function () {


    console.log('เข้ามาแล้ว');

    $('.showModalButton').bind('click', function () {

        if (!chkDatetime()) { //เช็คเทียบเวลาว่าง
            return false;
        }

        if (!compareTime()) { //เช็คเทียบเวลาว่าง
            return false;
        }


        $('#modal').modal('show');
        $('#modalHeader').html('<h4>' + $(this).attr('title') + '</h4>');

        //$('#new_country').on('pjax:end', function() {
        //$.pjax.reload({container: '#room-list'});  //Reload GridView
        //});     
        chkRageTime();


        /*
         if ($('#modal').data('bs.modal').isShown) {
         //$('#modal').find('#modalContent').load($(this).attr('value'));
         $('#main-content').load($(this).val());            
         $('#modalHeader').html('<h4>' + $(this).attr('title') + '</h4>');
         } else {
         //if modal isn't open; open it and load content
         $('#modal').modal('show').find('#main-content').load($(this).val());
         document.getElementById('modalHeader').innerHTML = '<h4>' + $(this).attr('title') + '</h4>';
         }
         */
    });

    $('#room-list').on('pjax:end', function () {
        /*alert(11);  //Reload GridView
         $('.select_room').each(function(index){
         alert($(this).data('key'));
         });*/
        
        // เช็คห้องว่างหรือไม่
        chkRageTime();


    });



    console.log('/เสร็วแล้ว');

    $('input#roomreserve-time_start , input#roomreserve-time_end').on('change', function () {
        compareTime();
    });
    
    $('input#roomreserve-date_start').on('change', function () {
        clearRoom();
    });


    $('._invttqadd').on('click', function (event) {
        event.preventDefault();
        $('#modal1').modal('show')
                .find('#modalcontent')
                .load($(this).attr('value'));
        return false;//just to see what data is coming to js
    });

    $('._belqadd').on('click', function (event) {
        event.preventDefault();
        $('#modal1').modal('show')
                .find('#modalcontent')
                .load($(this).attr('value'));
        return false;//just to see what data is coming to js
    });

}); //$(function)

function bindSelectItem() {
    $(document).on('click', '.select_room', function (e) {
        var room_id = $(this).closest('tr').data('key');
        var title = $(this).closest('tr').find('td:eq(1)').text();
        var details = $(this).closest('tr').find('td:eq(2)').text();
        //alert(room_id);
        $('input#roomreserve-room_id').val(room_id);
        $('div.data td.room_tile').text(title);
        $('div.data td.room_details').text(details);
        //$('input#roomreserve-room_id').val(room_id);
        $('#modal').modal('hide');

        /*
         $.get( 'view', { id: fID }, 
         function (data) { 
         $('#activity-modal').find('.modal-body').html(data); 
         $('.modal-body').html(data); 
         $('.modal-title').html('เปิดดูข้อมูลสมาชิก'); 
         $('#activity-modal').modal('show'); 
         }); 
         */
    });
}

//เช็คช่วงเวลา
function chkRageTime() {

    //alert(urlChkRoom);
    //console.log(toTimeStamp(date_start,time_start));
    $('.select_room').attr('disabled', false).removeClass('btn-danger').addClass('btn-primary').html('เลือกห้อง');
    $.getJSON(urlChkRoom, {
        start: toTimeStamp(date_start, time_start),
        end: toTimeStamp(date_start, time_end),
    }, function (data) {
        $.each(data, function (key, val) {

            //$.pjax.reload({container: '#room-list'});
            console.log(val.room_id);
            var room_id = val.room_id;
            var notempty = $('.select_room[value="' + room_id + '"]');
            $(notempty).attr('disabled', true);
            $(notempty).removeClass('btn-primary');
            $(notempty).addClass('btn-danger');
            $(notempty).html('ห้องไม่ว่าง');
        });
    });
    bindSelectItem();

}

/* เทียบเวลาทั้งหมด*/
function chkDatetime() {
    date_start = $('input#roomreserve-date_start');
    time_start = $('input#roomreserve-time_start');
    time_end = $('input#roomreserve-time_end');
    if (!$(date_start).val()) {
        alert('กรุณาเลือกวันที่!');
        $(date_start).focus();
        return false;
    }
    if (!$(time_start).val()) {
        alert('กรุณาเลือกเวลาเริ่ม');
        $(time_start).focus();
        return false;
    }
    if (!$(time_end).val()) {
        alert('กรุณาเลือกเวลาสิ้นสุด');
        $(time_end).focus();
        return false;
    }
    date_start = $(date_start).val();
    time_start = $(time_start).val();
    time_end = $(time_end).val();
    return true;
}


/* แปลงวันที่เป็น timestamp */
function toTimeStamp(strDate, strTime) {
    if (strDate) {
        var datetime = (strTime) ? strDate + ' ' + strTime + ':00' : strDate + ' 00:00:00';
        //console.log(datetime);
        //return Date.parse(datetime+"-0500") / 1000;
        return moment(datetime).unix();
        //return new Date(datetime).getTime();
    }
    return false;
}


/*เทียบเวลามากน้อย*/
function compareTime() {
    var dateStart = $('input#roomreserve-date_start').val();
/*
    if (!dateStart) {
        alert('กรุณาเลือกวันที่');
        $('input#roomreserve-date_start').focus();
        return false;
    }
    */

    var timeStart = $('input#roomreserve-time_start').val();
    var timeEnd = $('input#roomreserve-time_end').val();
    var t1 = toTimeStamp(dateStart, timeStart);
    var t2 = toTimeStamp(dateStart, timeEnd);
    console.log(t1 + ' ' + t2);
    clearRoom();
    if (t1 > t2) {
        //alert('เวลาเริ่มมากกว่าเวลาสิ้นสุด');
        $('input#roomreserve-time_end').focus();
        notbalance = true;
        return false;
    } else {
        notbalance = false;
        return true;
    }

}


function clearRoom(){
    $("input#roomreserve-room_id").val('');
    $(".data table tbody td.room_tile").text('');
    $(".data table tbody td.room_details").text('');    
}
