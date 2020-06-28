<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-bar-info-o fa-fw"></i> Project Details
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <form class="post_project_form" name="form" method="post" action="{{ route('projects.post.order') }}">
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
                            @if ($errors->has('subject'))
                                <p class="help-block">{{ $errors->first('subject') }}</p>
                            @endif
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
                            <input class="form-control has-error" type="text" value="{{ old('title', $fromhome['title']) }}" name="title" id="title" cols="50" required>
                            @if ($errors->has('title'))
                                <p class="help-block">{{ $errors->first('title') }}</p>
                            @endif
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
                                <input type='text' class="form-control" value="{{ old('homedate') }}" name="homedate"/>
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
                                <option @if(old('level') == 'High School') selected="selected" @endif value="High School">High School</option>
                                <option @if(old('level') == 'Undergraduate level 1-2') selected="selected" @endif value="Undergraduate level 1-2">Undergraduate level 1-2</option>
                                <option @if(old('level') == 'Undergraduate level 3-4') selected="selected" @endif value="Undergraduate level 3-4">Undergraduate level 3-4</option>
                                <option @if(old('level') == 'Masters level') selected="selected" @endif value="Masters level">Masters level</option>
                                <option @if(old('level') == 'PHD level') selected="selected" @endif value="PHD level">PHD level</option>
                            </select>
                            @if ($errors->has('level')) 
                                <p class="help-block">{{ $errors->first('level') }}</p>
                            @endif
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
                                @for ($i = 1; $i < 21; $i++)
                                    <option @if(old('numpages') == $i) selected="selected" @endif value="{{ $i }}">{{ $i }}</option>                                    
                                @endfor
                            </select>
                            @if ($errors->has('numpages'))
                                <p class="help-block">{{ $errors->first('numpages') }}</p>
                            @endif
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
                                <option @if(old('format') == 'APA') selected="selected" @endif value="APA">APA</option>
                                <option @if(old('format') == 'MLA') selected="selected" @endif value="MLA">MLA</option>
                                <option @if(old('format') == 'CHICAGO') selected="selected" @endif value="CHICAGO">CHICAGO</option>
                                <option @if(old('format') == 'HAVARD') selected="selected" @endif value="HAVARD">HAVARD</option>
                                <option @if(old('format') == 'OTHERS') selected="selected" @endif value="OTHERS">OTHERS</option>
                            </select>
                            @if ($errors->has('format'))
                                <p class="help-block">{{ $errors->first('format') }}</p>
                            @endif
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
                                <option @if($fromhome['budget'] == '$5-$10' ) selected="selected" @endif value="$5-$10">Mini
                                    Project ($5-10 USD)</option>
                                <option @if($fromhome['budget'] == '$10-$30' ) selected="selected" @endif value="$10-$30">Micro
                                    Project ($10-30 USD)</option>
                                <option @if($fromhome['budget'] == '$30-$100' ) selected="selected" @endif value="$30-$100">Standard
                                    Project ($30-100 USD)</option>
                                <option @if($fromhome['budget'] == '$100-$250' ) selected="selected" @endif value="$100-$250">Medium
                                    Project ($100-250 USD)</option>
                                <option @if($fromhome['budget'] == '$250-$500' ) selected="selected" @endif value="$250-$500">Large
                                    Project ($250-500 USD)</option>
                                <option @if($fromhome['budget'] == '$500-$1000' ) selected="selected" @endif value="$500-$1000">Major
                                    Project ($500-1000 USD)</option>
                            </select>
                            @if ($errors->has('budget'))
                                <p class="help-block">{{ $errors->first('budget') }}</p>
                            @endif
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Details</b></td>
                    <td>
                        <div class="form-group @if ($errors->has('description')) has-error @endif">
                            <textarea name="description" cols="70" rows="20" id="description"></textarea>
                            @if ($errors->has('description'))
                                <p class="help-block">{{ $errors->first('description') }}</p>
                            @endif
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