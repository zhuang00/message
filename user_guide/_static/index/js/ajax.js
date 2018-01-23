      $(function  () {
          
          $('.checkreg').blur(function() {

              that = $(this);
              data = that.val();
              name = that.attr('name');
                        
              if (that.val().length!=0) {
                        if (name == 'repassword') {
                          if (data == $('#password').val()) {
                            that.parent().siblings('.info').addClass('ok').removeClass('error').html('<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>'+'密码一致');
                            checksubimt()
                          }else{
                             that.parent().siblings('.info').addClass('error').removeClass('ok').html('<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>'+'密码不一致');
                             checksubimt()
                          }
                       
                       }
                          $.ajax({
                          url: './checkReg.php',
                          type: 'POST',
                          dataType: 'json',
                          data: {data: data,name: name},
                        })
                        .done(function(res) {
                          if(res.error==1){
                            that.parent().siblings('.info').addClass('error').removeClass('ok').html('<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>'+res.info);
                            checksubimt()
                          }else{
                            that.parent().siblings('.info').addClass('ok').removeClass('error').html('<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>'+res.info);
                            checksubimt()
                          }
                        
                        })
                        .fail(function() {
                          console.log("error");
                        })
              }else{
                that.parent().siblings('.info').html('<span></span>');
              }
            
          });
          function checksubimt(){
            num = $('.glyphicon-ok').length;
            if (num == 5) {
              $('#btn').attr('disabled', false)
            }else{
              $('#btn').attr('disabled', true)
            }
          }
        })