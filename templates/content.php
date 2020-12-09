<<div>
        <p style = "font-family: Verdana;font-weight: bold;color: green;position: relative;top: 35px; left: 155px;">
            Join in Intra University Social Network.<br>
            Connect with Friend.
        </p>
    <div id="img">
        <img src="images/outlook.png" height="380px" width="800px"
    </div>
    <div id ="right">
        <p style="font-size: 32px;color: midnightblue;font-weight: bold;"> Create an Account</p>
        <div id="form">
            <form id="signup_form" method="post">
                <table>
                    <tr>
                        <td>
                            <input type="text" name="u_name" required="required" placeholder="Full Name">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="Password" name="u_pass" required="required" placeholder="Enter your Password">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="email" name="u_email" required="required" placeholder="Enter your Email">
                        </td>
                    </tr>
                    <tr>
                        <td>Country</td>
                    </tr>

                    <tr>
                        <td>
                            <select name="u_country">
                                <option>Select a Country</option>
                                <option>Bangladesh</option>
                                <option>India</option>
                                <option>Pakistan</option>
                                <option>China</option>
                                <option>USA</option>
                                <option>UK</option>
                                <option>France</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Gender</td>
                    </tr>

                    <tr>
                        <td>
                            <select name="u_gender">
                                <option>Select a Gender</option>
                                <option>Male</option>
                                <option>Female</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Birthday
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="date"name="u_birthday" required="required" >
                        </td>
                    </tr>

                </table>
            </div>
            <input style="width: 200px;height: 45px;font-weight: bold;background: #464764; border-radius: 5px;border: 0.5px solid #7FFF00; color: white;"
                   type="submit" name="sign_up" value="Create an Account">
        <p style="padding: 3px;" class="message"> Already Have an Account? <br><button style="width: 60px;height: 30px;padding-bottom: 5px; background: #228822; border-radius: 5px;border: 0.5px solid #7FFF00; color: white;" id="sp_login"> Login </button> </p>

        <div>
          <?php include("insert_user.php"); ?>
        </div>
            </form>

    </div>
</div>
