
<?include('header.php');?>

<!-- eof header -->
<!-- main content -->
<div class="contact">
    <div class="contact-img"></div>
    <div class="contact-content">
        <div class="contact-header">
            <div class="bg-gray">2</div>

            <div class="contact-header-img">
                <img src="assets/images/Group 530@2x.png">
            </div>
        </div>
        <div class="contact-middle">
            <div class="row profile_title">
                <a href="index.php" class="profile_title_icon"><img src="assets/images/006-right-arrow.svg"></a>
            
                <h3 style="width: 50%;float: right;">درباره ما</h3>

            </div>
            <!--  -->
            <!--  -->
            <div class="row">
              <div class="rules-p">
                  <p>
                    <?= $action->get_system('about_us')?>
                  </p>
                  
              </div>
            </div>
        
        </div>
    </div>
</div>
<!-- footer -->
<?include('footer.php')?>

    
</body>
</html>