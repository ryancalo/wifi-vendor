<div class="container">
        <div class="row">

            <div style ='margin-top: 100px' class="col-md-4 col-sm-8 col-8 mx-auto">
                

                    <div class="card">

                        <div style = 'background-color:  #1C4E80  !important; color: #FFF' class="card-header">
                            <h5 class="panel-title">Login</h5>
                        </div>

                        <div class="card-body">

                                    <form role="form" action="<?php echo base_url('wifivendo/login')?>" method='POST'>
                                        <fieldset>
                                            <div class="form-group">
                                                <input class="form-control" placeholder="Username" name="username" type="text" autofocus required>
                                            </div>
                                            <div class="form-group">
                                                <input class="form-control" placeholder="Password" name="password" type="password" required>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                                </label>
                                            </div>
                                            <!-- Change this to a button or input when using this as a form -->
                                            <button style = 'background-color:  #ff6600 !important; color: #FFF' id="loginbtn2" class="btn btn-lg  btn-block" type ="submit">Login</button>
                                                         

                                        </fieldset>
                                    </form>
                        </div>
                    </div>


               
                    

            </div>
        </div>
</div>