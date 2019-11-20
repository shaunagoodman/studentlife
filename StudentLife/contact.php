<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>FAQ</title>

        <?php include_once 'includes/CDNs.php'; ?> 

        <link href="includes/stylesheet.css" rel="stylesheet" type="text/css"/>



    </head>
    <body>
        <?php include_once 'includes/nav-menu.php'; ?>  

        <div class="container" >
       <section id="contact">
  
  <h1 class="section-header">CONTACT</h1>
  
  <div class="contact-wrapper">
    
      <!---------------- 
​
      CONTACT PAGE LEFT 
    
      -----------------> 
    
    <form class="form-horizontal" role="form" method="post" action="contact.php">
       
      <div class="form-group">
        <div class="col-sm-12">
          <input type="text" class="form-control" id="name" placeholder="NAME" name="name" value="">
        </div>
      </div>
​
      <div class="form-group">
        <div class="col-sm-12">
          <input type="email" class="form-control" id="email" placeholder="EMAIL" name="email" value="">
        </div>
      </div>
​
      <textarea class="form-control" rows="10" placeholder="MESSAGE" name="message"></textarea>
      
      <button class="btn btn-primary send-button" id="submit" type="submit" value="SEND">
        <div class="button">
          <i class="fa fa-paper-plane"></i><span class="send-text">SEND</span>
        </div>
      
      </button>
      
    </form>
    
      <!---------------- 
​
      CONTACT PAGE RIGHT 
    
      -----------------> 
    
      <div class="direct-contact-container">
​
        <ul class="contact-list">
       
          
          <li class="list-item"><i class="fa fa-phone fa-2x"><span class="contact-text phone"><a href="tel:1-212-555-5555" title="Give me a call">(212) 555-2368</a></span></i></li>
          
          <li class="list-item"><i class="fa fa-envelope fa-2x"><span class="contact-text gmail"><a href="mailto:#" title="Send me an email">studentlife@mail.com</a></span></i></li>
          
        </ul>
​
       
​
      </div>
    
  </div>
  
</section>  
  

        
        
            </div>
        


        <?php include_once 'includes/footer.php'; ?>






    </body>
</html>
