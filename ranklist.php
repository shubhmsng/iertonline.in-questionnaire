<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="image/photo.jpg">

    <title>Questionnaire</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	<link rel="stylesheet" href="css/bootstrap-theme.min.css">
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	
	<script type="text/javascript">
		$(document).ready(function(){
			$("#myModal").on('show.bs.modal', function(event){
				var button = $(event.relatedTarget);  // Button that triggered the modal
				var titleData = button.data('title'); // Extract value from data-* attributes
				$(this).find('.modal-title').text(titleData);
			});
		});
	</script>
	<style type="text/css">
		.bs-example{
			margin: 20px;
		}
	</style>

  </head>

  <body>
  
  <div class="container">
		      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="home.php">Questionnaire</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">

            
              
              <?php
              	include "connectdb.php";
  				$rollno=$_SESSION['user'];
  				$query="select user from feedback where user=$rollno";
  				//echo $query;
  				$result = mysqli_query($con,$query);
  				$rows=mysqli_num_rows($result);
  				//echo $rows;
  				if ($rows == 0) {
      
              ?>
              <ul class="nav navbar-nav">
              <li><a href="home.php">Home <span class="glyphicon glyphicon-home"></span></a></li>
              
              <li ><a href="" data-toggle="modal" data-target="#about"  data-title="About">About <span class="glyphicon glyphicon-user"></span></a></li>
              <li><a href="" data-toggle="modal" data-target="#myModal"  data-title="Contact Us">Contact <span class="glyphicon glyphicon-earphone"></span></a></li>
            	</ul>
            	<?php 
            	}
            ?>
            

            <ul class="nav navbar-nav navbar-right">
            <?php
              	include "connectdb.php";
  				$rollno=$_SESSION['user'];
  				$query="select user from feedback where user=$rollno";
  				//echo $query;
  				$result = mysqli_query($con,$query);
  				$rows=mysqli_num_rows($result);
  				//echo $rows;
  				if ($rows != 0) {
      
              ?>
              <li><a href="main.php?data=1">Questions <span class="glyphicon glyphicon-dashboard"></span><span class="sr-only">(current)</span></a></li>
              <?php
              	}
              ?>
              <li class="active"><a href="ranklist.php?id=1">Ranklist <span class="glyphicon glyphicon-list-alt"></span></a></li>

              <li><a href="user.php">User<span class="glyphicon glyphicon-user"></span></a></li>
			  <li><a href="logout.php">Log Out <span class="glyphicon glyphicon-off"></span></a></li>

            </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>

      
	 
		<h1 align="center">Ranklist</h1>
		<!--
			<form class="navbar-form navbar-right" action="" role="search" method="post">
                <div class="input-group">
                    <input type="text" class="form-control" name="search_name" placeholder="Search by name">
                    <span class="input-group-btn">
                        <input type="submit" name="submit" value="submit" class="btn btn-default">
                        <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                        </button>
                    </span>
                </div>
            </form>
			-->
		<table class="table" border="1px">
			<thead>
				<tr>
					<th>#</th>
					<th>Roll No.</th>
					<th>Name</th>
					<th>College Name</th>
					<th>Branch</th>
					<th>Correct Answers</th>
					<th>Wrong Answers</th>
					<th>Total Points</th>		
				</tr>
			</thead>
			<tbody>
			<?php
			$con = mysqli_connect('localhost','shubhmsng','shubhmsng','id354464_questionnaire') or die("Unable to connect to MySQL");			
			include "calculation.php";
			$a=($_GET['id']-1)*10;
			$b=$_GET['id']*10;
			$que=mysqli_query($con, "SELECT * FROM ranklist WHERE id>=$a AND id<=$b ORDER BY rank ");
			while($que2=mysqli_fetch_array($que, MYSQLI_ASSOC))
			{
				$que3=mysqli_query($con, "SELECT * FROM registration WHERE rollno=$que2[rollno]");
			    $que4=mysqli_fetch_array($que3, MYSQLI_ASSOC);
				//echo $que2['rollno'],$_SESSION['user']."loged in";
				if($que2['rollno']!=$_SESSION['user'])
				echo "
				<tr class=\"warning\">
					<td>$que2[rank]</td>
					<td>$que2[rollno]</td>
					<td>$que4[name]</td>
					<td>$que4[college]</td>
					<td>$que4[branch]</td>
					<td>$que2[correct]</td>
					<td>$que2[wrong]</td>
					<td>$que2[correct]</td>		 
				</tr>
				";
				else
					echo "
				<tr class=\"\" style='background:#33CC33' >
					<td>$que2[rank]</td>
					<td>$que2[rollno]</td>
					<td>$que4[name]</td>
					<td>$que4[college]</td>
					<td>$que4[branch]</td>
					<td>$que2[correct]</td>
					<td>$que2[wrong]</td>
					<td>$que2[correct]</td>		 
				</tr>
				";
			}
				?>
						
			</tbody>
		</table>
	
        <ul class="pager">
        
        <?php
		$idc=$_GET['id'];
		$idp=$_GET['id']-1;
		$idn=$_GET['id']+1;
		echo "
		<div id=\"navbar\" class=\"navbar-collapse collapse\">
           <div class=\"col-md-4\">
		   <li class=\"previous\"><a href=\"ranklist.php?id=$idp\"><span aria-hidden=\"true\">&larr;</span> Previous</a></li>
			</div>
			<div class=\"col-md-4\">
			<ul class=\"nav navbar-nav\">
              <li><a href=\"ranklist.php?id=1\"><<</a></li>
              <li><a href=\"ranklist.php?id=2\">2</a></li>
              <li><a href=\"ranklist.php?id=3\">3</a></li>
              <li><a href=\"ranklist.php?id=4\">4</a></li>
			  <li><a href=\"ranklist.php?id=5\">5</a></li>
              <li><a href=\"ranklist.php?id=6\">>></a></li>
            </ul>
		</div>
		<div class=\"col-md-4\">
         <li class=\"next\"><a href=\"ranklist.php?id=$idn\">Next <span aria-hidden=\"true\">&rarr;</span></a></li> 
		 </div>
		</div>
		";
		  ?>
        </ul>
      
</div>
 <div id="about" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">About</h4>
                </div>
                <div class="modal-body">
                 <p style="color:#dd6f00; font-size:18px">Questionnaire is a CMS(Content Management System) which is developed by Btech(CSE) 3<sup>rd</sup> year students of IERT Allahabad. <br>
					Questionnaire provides you a platform where you can give or you can organize<br>MCQ based online test.<br>
					</p>
                </div>
                
            </div>
        </div>
    </div>
	
		 <div id="myModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Contact Us</h4>
                </div>
                <div class="modal-body">
					<p style="color:#dd6f00; font-size:18px">
						For any kind of information regarding Questionnaire you can contact us at
						questionnairecms@gmail.com
						<br><br>
						<span class="glyphicon glyphicon-earphone"></span> 
						+917783984676, +919984201321, +917054910780<br><br>
						<span class="glyphicon glyphicon-map-marker"> 
						 Institute of Engineering & Rural Technology<br>
						 &nbsp;&nbsp;26 Chaitham Lines<br>
						 &nbsp;&nbsp;Near Prayag Railway Station<br>
						 &nbsp;&nbsp;Allahabad 211002<br>
						
					</p>
					
				   
                </div>
                
            </div>
        </div>
    </div>
	 
</body>
</html>