<!DOCTYPE html>
<html lang = "eng">
	<head>
		<title>PCL Employee Attendance Record System</title>
		<?php include('header.php') ?>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
<script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js">
</script>
	</head>
	<body>
		<div style="background-color: white;">
		<div class = "container-fluid admin2">
			
			<div class="attendance_log_field">

				<div id="company-logo-field" class="mb-4 ">
					<img src="assets/img/circle.png" class="">
				</div>
				<div class="col-md-4 offset-md-4">
					<div class="card">
						<div class="card-title">
						</div>
						<div class="card-body">
              <div class="text-center">
                    <video id="preview" width="100%"></video>
              </div>
							<div class="text-center">
								<h4><?php echo date('F d,Y') ?> <span id="now"></span></h4>
							</div>
							<div class="col-md-14">
								<div class="text-center mb-4" id="log_display"></div>
									<form action="" id="att-log-frm" >
										<div class="form-group">
											<div class="text-center">
											<label for="eno" class="control-label">Employee Number</label>
											</div>
										<span>
											<input type="password" id="eno" name="eno" class="form-control col-sm-12">
										</span>
										</div>
										<center>
										<button type="button" class='btn btn-sm btn-primary log_now col-sm-3' data-id="Clock-in">
                                            <i class="fa fa-arrow-up"></i>
											IN-AM</button>
											<button type="button" class='btn btn-sm btn-primary log_now col-sm-3' data-id="Lunch-out">
                                             <i class="fa fa-arrow-down"></i>
											OUT AM</button>
										</center>
										<div>
											<label></label>
										</div>
										<center>
										<button type="button" class='btn btn-sm btn-primary log_now col-sm-3' data-id="Lunch-in">
                                            <i class="fa fa-arrow-up"></i>
											IN PM</button>
											<button type="button" class='btn btn-sm btn-primary log_now col-sm-3' data-id="Clock-out">
                                             <i class="fa fa-arrow-down"></i>
											OUT PM</button>
										</center>
										
										</div>
										<div class="loading" style="display: none"><center>Please wait...</center></div>
									</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		</div>
	</body>
	<script>
		$(document).ready(function(){
			setInterval(function(){
				var time = new Date();
				var now = time.toLocaleString('en-US', { hour: 'numeric', minute: 'numeric', second: 'numeric', hour12: true })
				$('#now').html(now)
			},500)
			console.log()

			$('.log_now').each(function(){
				$(this).click(function(){
					var _this = $(this)
					var eno = $('[name="eno"]').val()
					if(eno == ''){
						alert("Please enter your employee number");
					}else{
						$('.log_now').hide()		
						$('.loading').show()
						$.ajax({
							url:'./admin/time_log.php',
							method:'POST',
							data:{type:_this.attr('data-id'),eno:$('[name="eno"]').val()},
							error:err=>console.log(err),
							success:function(resp){
								if(typeof resp != undefined){
									resp = JSON.parse(resp)

									if(resp.status == 1){
										$('[name="eno"]').val('')
										$('#log_display').html(resp.msg)
										$('.log_now').show()		
										$('.loading').hide()
										setTimeout(function(){
										$('#log_display').html('')
										},5000)
									}else{
										alert(resp.msg)
										$('.log_now').show()		
										$('.loading').hide()
									}
								}
							}
						})		
					}
				})
			})
		})
	</script>
          <script>
           let scanner = new Instascan.Scanner({ video: document.getElementById('preview')});
           Instascan.Camera.getCameras().then(function(cameras){
               if(cameras.length > 0 ){
                   scanner.start(cameras[0]);
               } else{
                   alert('No cameras found');
               }
           }).catch(function(e) {
               console.error(e);
           });

           scanner.addListener('scan',function(c){
               document.getElementById('eno').value=c;
           });

        </script>
</html>