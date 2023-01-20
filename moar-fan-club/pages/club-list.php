<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
   <!-- Compiled and minified CSS -->

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

<!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

<style>
.manage__btn {
    box-sizing: border-box;
    padding: 1px !important;
}
.manage__btn button { 
    padding: 3px !important;
}
   .table tr td {
    font-size: 1.063rem;
    padding: 5px 21px !important;
}
.table tr th, .table tr td {
    font-size: 1.063rem;
    padding: 14px 21px !important;
    text-transform: uppercase;
    font-family: system-ui;
}
.moar-card {
    background-color: #172b4d;
    padding: 0px;
	color:white;
    border-radius: 20px;
    margin: 73px 20px 20px 0px;
}
.manage__btn img {
    width: 42px;
}
	.card-body th {
    text-align:center;  
    color: #f6f7f7f5;
}
	.manage__btn a{
		width:40px;
		padding:initial;
	}
	.manage__btn a {
    width: 29px;
    height: 32px;
}
.btn, .btn-large, .btn-small {
    color: #fff;
    background-color: #ffffff00;
    color: black;
	}
	.manage__btn button {
    height: 32px;
    padding: 3px !important;
    width: 28px;
    line-height: 29px;
}
	
td, textarea, input, select {
    background-color: #1D1D1D;
}
	.btn, .btn-large, .btn-small {
         text-decoration: none;
         color:#f00;
		 box-shadow:initial !important;
		
	}
	thead {
    background-color: #3D3D3D;
}
	.manage__btn a:focus {
		box-shadow:initial;
}
.manage__btn a {
    color: #9A9A9A!important;
}
.col-md-8-header img{
    height: 400px;
    width: 853px;
    margin-left: 20px;
    object-fit: cover;
    
}
	.cont-s{
    color:yellow;
  }
	.comp-s{
    color:green;
  }
	.comp-e{
    color:red;
  }
  .pl-3{
    padding-left:10px;
    padding-right:2px;
  }
  .col-md-8-header {
    flex: 0 0 auto;
    width: 66.6666666667%;
}
  .col-md-4-header {
    flex: 0 0 auto;
    width: 33.3333333333%;
}
.row-header {
    --bs-gutter-x: 1.5rem;
    --bs-gutter-y: 0;
    display: flex;
    flex-wrap: wrap;
    margin-top: calc(var(--bs-gutter-y) * -1);
    margin-right: calc(var(--bs-gutter-x)/ -2);
    margin-left: calc(var(--bs-gutter-x)/ -2);
}
.main-panel {
    background-color: #000;
    padding: 95px 62px;
}
.announcment-card .img {
    outline: 0;
    background-color: #505050;
    width: 61px;
    height: 54px;
    border-radius: 36px;
    margin: auto;
    display: block;
    margin-top: 73px;
}
.announcment-card .img img:nth-child(1) {
    line-height: 1.15;
    -ms-text-size-adjust: 100%;
    -webkit-text-size-adjust: 100%;
    margin: auto;
    display: block;
    padding-top: 11px;
}
.announcment-card .img img:nth-child(2) {
    position: relative;
    top: -32px;
    right: -10px;
}
.col-md-4-header {
    font-size: 12px;
    text-align: center;
    background-color: #1D1D1D;
}
.card-title {
    color: #D4D941;
}
.announcment-card h4 {
    color: white;}
    .jdg-mrk-upload {
    outline: 0;
    color: #ffffffa1;
}

  </style>

    <div class="main-panel">
         <div class="row-header">
            <div class="col-md-4-header">
              <div class="announcment-card">
                    <div class="img"> 
                      <img src="<?php echo get_site_url(); ?>/wp-content/uploads/2021/08/bullhorn.png" />
                      <img src="<?php echo get_site_url(); ?>/wp-content/uploads/2021/08/Ellipse-52.png" />
                    </div>
                   <h4>Fan Club</h4>
                  <div class="jdg-mrk-upload">club<br/>Uploaded</div>
               </div>
            </div>
            <div class="col-md-8-header">
              <img class="com-list-img" src="<?php echo get_site_url(); ?>/wp-content/uploads/2021/08/pexels-wendy-wei-1190298.jpg" />
            </div> 
            
        </div>
        <!-- comp list and notification with pagination -->
             <div class="card-header card-header-primary">
                  <h4 class="card-title ">Club List</h4>
                   
                </div>
                <!-- table body start -->
          <div class="row">
            <div class="col-md-12">
              <div class="moar-card">
               
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead class=" text-primary">
                        <th>
                          #
                        </th>
                        <th>
                          Name
                        </th>
						 
                        <th>
                          Start Date/Time
                        </th>
                        <th>
                         End Date/Time
                        </th>
                      <th class='manage__btn'>
                        Update
                      </th><th class='manage__btn'>
                        Delete
                      </th>
                    <th class="manage__btn">
                         Status
                        </th>
                       
                          </thead>  
                       <tbody>
                       
                      
                                  </tbody>
                     
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>  
                    </div>
                  </div>
          <?php 
          