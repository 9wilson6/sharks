<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-bar-info-o fa-fw"></i> Project Details
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <form class="post_project_form" name="form" method="post" action="{{ url('/account/post_project') }}">
        {{ csrf_field() }}
        <?php $fromhome = Session::get('fromhome'); ?>
            <table class="table table-bordered table-hover table-striped">
                <tr>
                    <td valign="top">
                        <label for="subject">Subject*</label>
                    </td>
                    <td valign="top">
                    <div class="form-group @if ($errors->has('subject')) has-error @endif">
                        <select class="form-control" name="subject" id="subject" required>
                        <option value="">Please select a subject</option>
                        @foreach($subjects as $subject)
                          <option @if($subject->subjects == $fromhome['subject']) selected="selected" @endif value="{{ $subject->subjects }}">{{ $subject->subjects }}</option>
                        @endforeach
                        </select>
                        @if ($errors->has('subject')) <p class="help-block">{{ $errors->first('subject') }}</p> @endif
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>
                            <label for="title">Title*</label>
                        </p>
                    </td>
                    <td>
                    <div class="form-group @if ($errors->has('category')) has-error @endif">
                        <input class="form-control has-error" type="text" value="{{ $fromhome['title'] }}" name="title" id="title" cols="50" required>
                        @if ($errors->has('title')) <p class="help-block">{{ $errors->first('title') }}</p> @endif
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>
                            <label for="example2">Date &amp; Time Due <span class="text-info">(UTC time)</span></label>                            
                        </p>
                    </td>
                    <td>
                        <div class="form-group @if ($errors->has('homedate')) has-error @endif">
                            <div class='input-group date' id='postdeadline'>
                                <input type='text' class="form-control" value="{{ old('homedate') }}" name="homedate" required/>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                            @if ($errors->has('homedate'))
                            <p class="help-block">{{ $errors->first('homedate') }}</p>
                            @endif
                        </div>
                    </td>
                </tr>
                <tr>
                    <td valign="top">
                        <label for="level">Level of study*</label>
                    </td>
                    <td valign="top">
                    <div class="form-group @if ($errors->has('level')) has-error @endif">
                        <select class="form-control" name="level" id="level" required>
                           <option value="">Please select level of study</option>
                            <option value="High School">High School</option>
                            <option value="Undergraduate level 1-2">Undergraduate level 1-2</option>
                            <option value="Undergraduate level 3-4">Undergraduate level 3-4</option>
                            <option value="Masters level">Masters level</option>
                            <option value="PHD level">PHD level</option>
                        </select>
                        @if ($errors->has('level')) <p class="help-block">{{ $errors->first('level') }}</p> @endif
                        </div>
                    </td>
                </tr>
                <tr>
                    <td valign="top">
                        <label for="numpages">Number of Pages*</label>
                    </td>
                    <td valign="top">
                    <div class="form-group @if ($errors->has('numpages')) has-error @endif">
                        <select class="form-control" name="numpages" id="numpages" required>
                        <option value="">Please select number of pages</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                            <option value="13">13</option>
                            <option value="14">14</option>
                            <option value="15">15</option>
                            <option value="16">16</option>
                            <option value="17">17</option>
                            <option value="18">18</option>
                            <option value="19">19</option>
                            <option value="20">20</option>
                            <option value="0">Not specified</option>
                        </select>
                        @if ($errors->has('numpages')) <p class="help-block">{{ $errors->first('numpages') }}</p> @endif
                        </div>
                    </td>
                </tr>
                <tr>
                    <td valign="top">
                        <label for="format">Format*</label>
                    </td>
                    <td valign="top">
                    <div class="form-group @if ($errors->has('format')) has-error @endif">
                        <select class="form-control" name="format" id="format" required>
                        <option value="">Please select format</option>
                            <option value="APA">APA</option>
                            <option value="MLA">MLA</option>
                            <option value="CHICAGO">CHICAGO</option>
                            <option value="HAVARD">HAVARD</option>
                            <option value="OTHERS">OTHERS</option>
                        </select>
                        @if ($errors->has('format')) <p class="help-block">{{ $errors->first('format') }}</p> @endif
                        </div>
                    </td>
                </tr>
                <tr>
                    <td valign="top">
                        <label for="format">Budget*</label>
                    </td>
                    <td valign="top">
                    <div class="form-group @if ($errors->has('budget')) has-error @endif">
                        <select class="form-control" name="budget" id="budget" required>
                        <option value="">Please select budget</option>
                           <option @if($fromhome['budget'] == '$5-$10') selected="selected" @endif value="$5-$10">Mini Project ($5-10 USD)</option>
                            <option @if($fromhome['budget'] == '$10-$30') selected="selected" @endif value="$10-$30">Micro Project ($10-30 USD)</option>
                            <option @if($fromhome['budget'] == '$30-$100') selected="selected" @endif value="$30-$100">Standard Project ($30-100 USD)</option>
                            <option @if($fromhome['budget'] == '$100-$250') selected="selected" @endif value="$100-$250">Medium Project ($100-250 USD)</option>
                            <option @if($fromhome['budget'] == '$250-$500') selected="selected" @endif value="$250-$500">Large Project ($250-500 USD)</option>
                            <option @if($fromhome['budget'] == '$500-$1000') selected="selected" @endif value="$500-$1000">Major Project ($500-1000 USD)</option>
                        </select>
                        @if ($errors->has('budget')) <p class="help-block">{{ $errors->first('budget') }}</p> @endif
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Details</b></td>
                    <td>
                    <div class="form-group @if ($errors->has('description')) has-error @endif">
                        <textarea name="description" cols="70" rows="20" id="description"></textarea>
                        @if ($errors->has('description')) <p class="help-block">{{ $errors->first('description') }}</p> @endif
                        </div>
                    </td>
                </tr>
                <tr>
                    <td><i>You Can Attach Files After You Submit</i></td>
                    <td></td>
                </tr>
            </table>
            <input name="submit" type="submit" value="Post Project Now" class="btn btn-primary btn-block btn-lg" tabindex="7">
            </form>
        <hr>
    </div>
</div>
