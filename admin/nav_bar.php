		<nav class = "navbar navbar-header navbar-dark bg-dark">
			<div class = "container-fluid">
				<div class = "navbar-header">
					<p class = "navbar-text pull-right">Precision Clinical Laboratory</p>
				</div>
				<div class = "nav navbar-nav navbar-right">
					<a href="logout.php" class="text-light"><?php echo $user_name ?> <i class="fa fa-power-off"></i></a>
				</div>
			</div>
		</nav>
		<div id="sidebar" class="bg-dark" style="height: 100%;">
			<div id="sidebar-field">
				<a href="home.php" class="sidebar-item">
						<div class="sidebar-icon"><i class="fa fa-dashboard"> </i></div>  Dashboard
				</a>
			</div>
			<div id="sidebar-field">
				<a href="employee.php" class="sidebar-item">
						<div class="sidebar-icon"><i class="fa fa-group"> </i></div>  Employee
				</a>
			</div>
			<div id="sidebar-field">
				<a href="qrcode.php" class="sidebar-item">
						<div class="sidebar-icon"><i class="fa fa-qrcode"> </i></div>  QR Code
				</a>
			</div>
			<div id="sidebar-field">
				<a href="attendance.php" class="sidebar-item">
						<div class="sidebar-icon"><i class="fa fa-clock-o"> </i></div>  Attendance
				</a>
			</div>
			<div id="sidebar-field">
				<a href="Schedull.php" class="sidebar-item">
						<div class="sidebar-icon"><i class="fa fa-calendar"> </i></div>  Schedule
				</a>
			</div>
			<div id="sidebar-field">
				<a href="emp_schedule.php" class="sidebar-item">
						<div class="sidebar-icon"><i class="fa fa-calendar-check-o"> </i></div>  Employee Week-Schedule
				</a>
			</div>
			<div id="sidebar-field">
				<a href="payroll.php" class="sidebar-item">
						<div class="sidebar-icon"><i class="fa fa-credit-card"> </i></div>  Pay Roll
				</a>
			</div>
			<div id="sidebar-field">
				<a href="thread.php" class="sidebar-item">
						<div class="sidebar-icon"><i class="fa fa-database"> </i></div> Optimize DB
				</a>
			</div>
			<div id="sidebar-field">
				<a href="users.php" class="sidebar-item">
						<div class="sidebar-icon"><i class="fa fa-users"> </i></div>  Users
				</a>
			</div>
			<div id="sidebar-field">
				<a href="report.php" class="sidebar-item">
						<div class="sidebar-icon"><i class="fa fa-file"> </i></div>Report
				</a>
			</div>

		</div>
		<script>
			$(document).ready(function(){
				var loc = window.location.href;
				loc.split('{/}')
				$('#sidebar a').each(function(){
				// console.log(loc.substr(loc.lastIndexOf("/") + 1),$(this).attr('href'))
					if($(this).attr('href') == loc.substr(loc.lastIndexOf("/") + 1)){
						$(this).addClass('active')
					}
				})
			})
			
		</script>