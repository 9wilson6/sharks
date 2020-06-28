<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading"> <i class="fa fa-clock-o fa-fw"></i> Compose
        </div>
        <div class="panel-body">
            <form method="post" name="form" onsubmit="return validate(this)" enctype="multipart/form-data" action="https://www.myhomeworkshark.com/index.php/account/send_messo">
                <input type="hidden" name="pid" value="" /> <b>Your privacy matters, do not give out contact information</b>
                <table class="table table-bordered table-hover table-striped">
                    <tr>
                        <td>To</td>
                        <td>
                            <input class="form-control" type="text" name="touser" id="touser" value="" />
                        </td>
                    </tr>
                    <tr>
                        <td>Message</td>
                        <td>
                            <textarea name="message" cols="90" rows="20" id="message"></textarea>
                        </td>
                    </tr>
                    <!--    <tr>
                                    <td>Upload file</td>
                                    <td>
                                        <input name="uploaded" type="file" />
                                    </td>
                                </tr>
                                -->
                    <tr>
                        <td></td>
                        <td> <b>You can attach files after you send message</b>
                        </td>
                    </tr>
                </table>
                <br>
                <button class="btn btn-danger btn-block btn-lg" tabindex="7" type="submit" name="submit" value="Submit" id="submitButton">Send Message</button>
            </form>
            <br>
            <br>
        </div>
    </div>
</div>
