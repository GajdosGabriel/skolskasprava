
<!-- footer -->
<div class="footer" style="background: rgba(5, 17, 53, 0.96);" content="mt-5">
    <div class="container">
        <hr class="footer-line">
        <div class="row ">
            <!-- footer-about -->
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-6 ">
                <div class="footer-widget ">
                    <div class="footer-title text-white-50 mb-2">Kontakt</div>
                    <ul class="list-unstyled">
                        <li class="text-white-50">Tel.: 0905 320 616</li>
                    </ul>
                </div>
            </div>
            <!-- /.footer-about -->

            <!-- footer-about -->
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-6 ">
                <div class="footer-widget ">
                    <div class="footer-title text-white-50 mb-2">Informácia</div>
                    <ul class="list-unstyled">
                        <li class="text-white-50">Aplikácia je v skúšobnej prevádzke. V tejto chvíli je používanie bezplatné.</li>
                    </ul>
                </div>
            </div>
            <!-- /.footer-about -->
            <!-- footer-about -->
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-6 ">
                <div class="footer-widget ">
                    <div class="footer-title text-white-50 mb-2">Podnety a opravy pre programátora</div>
                    @auth
                    <form method="post" action="{{ route('messenger.store', [1]) }}">
                        {{ csrf_field() }}
                        <textarea name="body" rows="5" style="width: 100%; color: black" required placeholder="Napíšte nám svoje otázky ... Ďakujeme" value="{{ old('body') }}"></textarea>
                       <input type="hidden" name="requested_user" value="1">
                        <div class="form-group">
                            <button type="submit" class="btn btn-sm pull-right">Odoslať <span class="glyphicon glyphicon-envelope"></span></button>
                        </div>
                    </form>
                    @endauth
                </div>
            </div>
            <!-- /.footer-about -->
            <!-- tiny-footer -->
        </div>
        <div class="row ">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-center ">
                <div class="tiny-footer">
                    <p class="text-white-50">Copyright © Všetky práva vyhradené 2018 | Desing by Gabriel</p>
                </div>
            </div>
            <!-- /. tiny-footer -->
        </div>
    </div>
</div>
<!-- /.footer -->