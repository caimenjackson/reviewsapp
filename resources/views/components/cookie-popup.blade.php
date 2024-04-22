@if(!request()->cookie('cookie_consent'))
    <div class="cookie-popup-container bg-yellow-500" style="position: fixed; bottom: 20px; left: 50%; transform: translateX(-50%); width: 80%; max-width: 2000px; min-height: 10%; z-index: 9999; border: 1px solid #ccc; border-radius: 8px; padding: 20px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
        <div class="cookie-popup" style="display: flex; align-items: center;">
            <i class="fa-solid fa-cookie-bite text-black" style="margin-right: 10px;"></i>
            <p style="margin: 0; padding: 0;" class="text-black">This website uses cookies to ensure you get the best experience. <a href="/termsandconditions">Learn more</a></p>
        </div>
        <div class="cookie-buttons" style="display: flex; justify-content: space-between; align-items: center; border-top: 1px solid #ccc; padding-top: 10px;">
            
            
            <form action="/accept-cookies" method="post" style="margin: 0;">
                @csrf
                <button type="submit" class="btn btn-primary" style="border: 2px solid #00b300; border-radius: 20px; padding: 8px 16px; background-color: #00b300;">
                    <div style="display: flex; align-items: center;">
                        <i class="fa-solid fa-circle-check" style="margin-right: 5px;"></i>
                        <span>Accept</span>
                    </div>
                </button>
            </form>
            <button class="btn btn-secondary" onclick="declineCookies()" style="border: 2px solid #ffffff; border-radius: 20px; padding: 8px 16px; background-color: #ffffff;">
                <div style="display: flex; align-items: center;">
                    <i class="fa-solid fa-circle-xmark text-black" style="margin-right: 5px;"></i>
                    <span class="text-black">Decline</span>
                </div>
            </button>
        </div>
    </div>
@endif
