# OAuth API
[![forthebadge](http://forthebadge.com/images/badges/uses-css.svg)](http://forthebadge.com)
## 功能
-  二步驟驗證(Telegram & Google二步驟)
-  非網頁應用程式登入
-  做用Google , Github , IMUS 作登入API
-  使用者不用再記不同系統的登入資訊
-  完全開源
-  無須MySQL

## 調用方法(網頁應用程式)
- 傳送登入要求
- http[s]://[your_domain]/?url=[where you want to redirect]
- 接收
- http[s]://[your_redirected_url]/?userid=[username]&method=[method]&id=[id]&img=[profile_image]&displayname=[name_that display]&twofamethod=[using_which_method_to_authenction]&timestamp=[timestamp_in_unix_format]

## 調用方法(其他應用程式)
- 傳送登入要求
- http[s]://[your_domain]/?url=api/ok.html
- 接收
- http[s]://[your_domain]/?api_key=[api_key_that_spefticed_in_api.json] (JSON 格式)

## 運作原理
![Image](http://i.imgur.com/91YxEj6.png)
- 系統並不會儲存任何密碼或其他敏感資料
- 系統只會儲放Telegram UID , Google Authenticator Secret , e-mail

## 本系統使用了下列的資源庫／CSS／登入驗證系統，特此致謝
- PHPGangsta (Google Authenticator) https://github.com/PHPGangsta/GoogleAuthenticator
- JQuery (JS) https://jquery.com/
- Bootstrap & Bootswatch (CSS) http://bootswatch.com/
- TocasUI (CSS) https://tocas-ui.com/
- Google OAuth (Authenction) https://google.com
- Telegram (Authenction) https://telegram.org
- Github (Authenction) https://github.com
- IMUS (Authenction) http://imuslab.com

