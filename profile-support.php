<style>
    .accordion {
    background-color: #eee;
    color: #444;
    cursor: pointer;
    padding: 18px;
    width: 100%;
    border: none;
    text-align: right;
    outline: none;
    font-size: 15px;
    transition: 0.4s;
  }
  
  .active, .accordion:hover {
    background-color: #ccc;
  }
  
  .accordion:after {
    content: '\002B';
    color: #777;
    font-weight: bold;
    float: left;
    margin-left: 5px;
  }
  
  .active:after {
    content: "\2212";
  }
  
  .panel {
    padding: 0px 18px;
    background-color: white;
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.2s ease-out;
  }
  .accordion h4 {
  max-width: 40%;
  float: right;
}

.accordion p {
  max-width: 20%;
  float: right;
  padding-right: 16px;
  padding-top: 2px;
}

.panel p {
  margin: 10px 0 -2px 0;
  width: 100%;
  /* display: table; */
}
  </style>
<?
$messages = $action->supporter_message_list($id);
?>
<div class="edit_profile_div">

              
<div class="profile_header">
    <div class="profile_heade_inn">
        <div class="profile_header_img_2"><img src="assets/images/icons8-question-mark-96.png"></div></div>
        
</div>
<div class="row profile_title">
    <a class="profile_title_icon"><img src="assets/images/006-right-arrow.svg"></a>
    <h3 style="width: 50%;float: right;">پاسخ به سوالات</h3>
    <img src="assets/images/Group 523@2x.png">
  
</div>
<div class="profile_left profile_left2" style="padding-top: 0;">
    <div class="hami_acc">

        <!--each accordion  -->
        <?
            while($message = $messages->fetch_object()){
        ?>
        <button class="accordion hami_check" >
        <span <?if($message->status == 1){ ?>style="display:block;" <?}?>class="ticket_check"><i class="fa fa-check" aria-hidden="true"></i></span>
        <h4 id="<?= $message->from_id ?>"><?= $action->marketer_get($message->from_id)->first_name." ".$action->marketer_get($message->from_id)->last_name?></h4>
        <p><?= $action->time_to_shamsi($message->created_at) ?></p>
        </button>
        <div class="panel" >
        <p id="<?= $message->id ?>"><?= $message->text ?></p>
        <button class="ans-ticket ans-aj">پاسخ</button>
        </div>
        <?}?>
        <!--  -->
      
    </div>

   
</div>
</div>
<div class="darklayer"></div>
<div class="formpopup">
    <div class="" style="width: 100%;display: table;">    <i class="close fa fa-times"></i>
    </div>
    <div class="pheader">   
        <p>
            پاسخ به 
            
        </p>
        <h4 id="user_name">علی علوی</h4>
    </div>
    <p class="alert_text">متن پیام نمیتواند خالی باشد</p>
    <form>
        <textarea value="پاسخ خود را وارد نمایید">

        </textarea>
        <a id="send-answre"  class="ans-ticket">ارسال</a>
    </form>
    
</div>
<script>
    // accordion
    var acc = document.getElementsByClassName("accordion");
    var i;
    
    for (i = 0; i < acc.length; i++) {
      acc[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var panel = this.nextElementSibling;
        if (panel.style.maxHeight) {
          panel.style.maxHeight = null;
        } else {
          panel.style.maxHeight = panel.scrollHeight + "px";
        } 
      });
    }

    $('.close').click(function(){
        $('.formpopup').fadeOut();
        $('.darklayer').hide();
        $('body').css('overflow','auto');
    });
    var user_id;
    var question_id;
    var support_id = <?= $id?>;
    var ans_btns = document.getElementsByClassName("ans-aj");
    for (i = 0; i < ans_btns.length; i++) {
        ans_btns[i].addEventListener("click", function() {
            $('.darklayer').show();
            $('html,body').scrollTop(0);
            $('body').css('overflow','hidden');
            $('.formpopup').fadeIn();
            user_id = this.parentElement.previousElementSibling.firstElementChild.nextElementSibling.id; 
            question_id = this.previousElementSibling.id;
            $('#user_name').text( document.getElementById(user_id).innerHTML)
      });
    }

    $('#send-answre').click(function(e){
 
        let text = this.previousElementSibling.value;
        if(text == null) {
             $('.alert_text').fadeIn();
        }else{
            
            $.ajax({
                type : "POST",
                url : "ajax/support-send-answer.php",
                data:{text:text,user_id:user_id,question_id:question_id,support_id:support_id},
                success : function(data){
                     $('.formpopup').hide();
                     $('.darklayer').hide();
                     $('.alert_text').hide();
                     $('body').css('overflow','auto');
                    //  alert(user_id,question_id)
                      document.getElementById(user_id).previousElementSibling.style.display='block';
                      location.reload(true); 
                }
            });
        }
    })
     
    </script>
