# OAuth API
- 目前組建 : Release 2.0.0 20171204192853
## 功能
-  二步驟驗證(Telegram & Google二步驟)
-  非網頁應用程式登入
-  做用Google , Github , IMUS 作登入API
-  使用者不用再記不同系統的登入資訊
-  完全開源
-  無須MySQL

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

