{{--  Login | Signup Modal  --}}
<div class="modal fade" id="loginSignupModal" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">You need to be registered to view this lodge<br/>
                    {{--                        <span class="small text-secondary"></span>--}}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <a href="/login" class="btn btn-outline-primary btn-block">Login</a>
                <a href="/register" class="btn btn-outline-success btn-block">Register</a>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                </button>
                {{--                        <button type="submit" class="btn btn-primary">Save changes</button>--}}
            </div>
        </div>
    </div>
</div>
{{--  Flagging Modal  --}}
<div class="popup-div d-none" id="reasonForFlagging">
    <div class="outside">
    </div>
    <div class="card col-md-6 mx-auto">
        <div class="card-body" id="reasonCard">
            <h5 class="card-title text-center">Why flag this ad?</h5>
            <div class="text-danger small">
            </div>
            <textarea name="reason_for_flag" placeholder="Reason For Flagging" class="form-control"></textarea>
            <button role="button" type="button" class="btn btn-primary d-block ml-auto mt-1">Submit</button>
        </div>
        <div class="card-body d-none" id="successMessage">
            <div class="text-center">
                <i class="fas fa-check-circle fa-5x text-success"></i>
                <br/>
                <h5>Flag request sent successfully</h5>
            </div>
            <button role="button" type="button" id="closeReason" class="btn btn-dark d-block ml-auto mt-1">Close
            </button>
        </div>
    </div>
</div>
{{--  Share Button Modal  --}}
<div class="modal fade" id="socialMediaShareModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Share The Link On Your Social Media Account<br />
                    {{--                        <span class="small text-secondary"></span>--}}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-3">
                        <iframe
                            src="https://www.facebook.com/plugins/share_button.php?href=https%3A%2F%2Fwww.campuslodges.com%2Flodges%2F2&layout=button&size=large&width=77&height=28&appId"
                            width="77" height="28" style="border:none;overflow:hidden" scrolling="no" frameborder="0"
                            allowTransparency="true" allow="encrypted-media"></iframe>
                    </div>
                    <div class="col-3">
                        <a href="https://twitter.com/intent/tweet" class="twitter-share-button"
                            data-text="https://www.campuslodges.com" data-url="https://www.campuslodges.com" data-show-count="false">Tweet</a>
                        {{--  <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>  --}}
                    </div>
                    <div class="col-3"></div>
                </div>
                
            </div>
            <div class="modal-footer">
                {{--  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                </button>  --}}
                {{-- <button type="submit" class="btn btn-primary">Save changes</button>--}}
            </div>
        </div>
    </div>
</div>