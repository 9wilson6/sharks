<style>
    .orderformhome{
        /*background-color: #1b4d6e;*/
        background-color: rgba(76, 84, 129, 0.79);
        padding: 15px;
        border-radius: 5px;
        border-color: black;
    }
    .lablesd{
        text-decoration: bold;
        font-size: 16px;
        color: white;
        font-weight: bold;
    }
</style>
<section id="home" class="dzsparallaxer auto-init dzsparallaxer---window-height use-loading" style="position: relative; height: 800px;" data-options='{  mode_scroll: "normal" }'>
    <div class="divimage dzsparallaxer--target " data-src="{{ asset('img/bg1.jpg') }}" style="width: 100%; height: 130%; background-image: url()">
        <div class="hero-parallax">
            <div class="hero-inner">
                <div class="hero-content">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 hidden-xs">
                                <div class="col-md-10">
                                    <div class="hero-static">
                                        <h1>Give your grades a boost!</h1>
                                        <p class="lead">
                                            Get homework help from professional tutors
                                        </p>
                                        <div class="buttons">
                                            <a href="{{ url('/register') }}" class="btn btn-xl btn-primary">Click to get instant help</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 orderformhome">
                                <h3 style="color: white;">Post project now</h3>
                                <hr>
                                <form action="{{ url('/pages/postproject') }}" method="POST" class="form-horizontal" role="form">
                                    {{ csrf_field() }}
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <label class="lablesd" for="email">Email Address:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="email" maxlength="30" name="email" class="form-control" placeholder="Email" required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <label class="lablesd" for="email">Title:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" maxlength="70" name="title" class="form-control" placeholder="Title">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <label class="lablesd" for="subject">Subject:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <select class="form-control" name="subject" id="subject">
                                            <option value="">Please select a subject</option>
                                            @foreach($subjects as $subject)
                                              <option value="{{ $subject->subjects }}">{{ $subject->subjects }}</option>
                                            @endforeach
                                            </select>
                                        </select>
                                        </div>                                       
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <label class="lablesd" for="subject">Budget:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <select class="form-control" name="budget" id="budget">
                                            <option value="">Please select budget</option>
                                               <option value="$5-$10">Mini Project ($5-10 USD)</option>
                                                <option value="$10-$30">Micro Project ($10-30 USD)</option>
                                                <option value="$30-$100">Standard Project ($30-100 USD)</option>
                                                <option value="$100-$250">Medium Project ($100-250 USD)</option>
                                                <option value="$250-$500">Large Project ($250-500 USD)</option>
                                                <option value="$500-$1000">Major Project ($500-1000 USD)</option>
                                            </select>
                                        </div>                                        
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary pull-right">Continue <i class="fa fa-arrow-right"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>