<h3 class="apih">API Delicatos</h3>
<div class="left_bar">
    <div class="api_block">
        <p>Получить access token</p>
        <p><span>POST</span> https://katrin.school-php.com/api/test/api/test/{login}/{password}/{format}</p>
        <p>Возвращает токен для работы с аккаунтом</p>
        <p>Параметры</p>
        <table>
            <tr>
                <td>string</td>
                <td>login</td>
                <td>логин для входа на сайт, обязательный параметр</td>
            </tr>
            <tr>
                <td>string</td>
                <td>password</td>
                <td>пароль для входа на сайт, обязательный параметр</td>
            </tr>
            <tr>
                <td>string</td>
                <td>format</td>
                <td>желаемый формат ответа - json (по дефолту) xml, необязательный параметр</td>
            </tr>
        </table>
        <p>Ответ:</p>
        <table>
            <tr>
                <td>string</td>
                <td>status</td>
                <td>"ok" or "no"</td>
            </tr>
            <tr>
                <td>string</td>
                <td>secret_key</td>
                <td>значение токена</td>
            </tr>
            <tr>
                <td>string</td>
                <td>error</td>
                <td>в случае ошибки - сообщение об ошибке</td>
            </tr>
        </table>
        <p>Test: get secret key</p>
        <form method="post" name="form_secret" action="" onsubmit="return apiAjax('form_secret');">
            <p><input type="text" name="login" placeholder="Login" onfocus="placeholder=''"></p>
            <p><input type="password" name="password" placeholder="Password" onfocus="placeholder=''"></p>
            <p><input type="text" name="format" placeholder="json" onfocus="placeholder=''"></p>
            <input type="hidden" name="secret_button">
            <p><input type="submit" value="Send"></p>
        </form>
    </div>
    <div class="api_block">
        <p>Kакие соц.сети прикреплены к данному аккаунту на вашем сайте</p>
        <p><span>POST</span> https://katrin.school-php.com/api/test/api/test/{token}/{format}</p>
        <p>Возвращает перечень соцсетей, прикрепленных к аккаунту на сатйе</p>
        <p>Параметры</p>
        <table>
            <tr>
                <td>string</td>
                <td>token</td>
                <td>индивидуальный токен, обязательный параметр</td>
            </tr>
            <tr>
                <td>string</td>
                <td>format</td>
                <td>желаемый формат ответа - json (по дефолту) xml, необязательный параметр</td>
            </tr>
        </table>
        <p>Ответ:</p>
        <table>
            <tr>
                <td>string</td>
                <td>status</td>
                <td>"ok" or "no"</td>
            </tr>
            <tr>
                <td>string</td>
                <td>socials</td>
                <td>перечень соцсетей данного аккаунта</td>
            </tr>
            <tr>
                <td>string</td>
                <td>error</td>
                <td>в случае ошибки - сообщение об ошибке</td>
            </tr>
        </table>
        <p>Test: get social list</p>
        <form method="post" name="form_socials" action="" onsubmit="return apiAjax('form_socials');">
            <p><input type="text" name="secret" placeholder="access token" onfocus="placeholder=''"></p>
            <p><input type="text" name="format" placeholder="json" onfocus="placeholder=''"></p>
            <input type="hidden" name="socials_button">
            <p><input type="submit" value="Send"></p>
        </form>
    </div>
    <div class="api_block">
        <p>Отправить запрос на удаление авторизации через соц.сети на сайте </p>
        <p><span>DELETE</span> https://katrin.school-php.com/api/test/api/test/{token}/{format}</p>
        <p>Позволяет удалить привязку конкретной соцсети, прикрепленной к аккаунту</p>
        <p>Параметры</p>
        <table>
            <tr>
                <td>string</td>
                <td>token</td>
                <td>индивидуальный токен, обязательный параметр</td>
            </tr>
            <tr>
                <td>integer</td>
                <td>social_id</td>
                <td>идентификатор соцсети, обязательный параметр</td>
            </tr>
            <tr>
                <td>string</td>
                <td>format</td>
                <td>желаемый формат ответа - json (по дефолту) xml, необязательный параметр</td>
            </tr>
        </table>
        <p>Ответ:</p>
        <table>
            <tr>
                <td>string</td>
                <td>status</td>
                <td>"ok" or "no"</td>
            </tr>
            <tr>
                <td>string</td>
                <td>delete</td>
                <td>сообщение об удалении соцсети данного аккаунта</td>
            </tr>
            <tr>
                <td>string</td>
                <td>error</td>
                <td>в случае ошибки - сообщение об ошибке</td>
            </tr>
        </table>
        <p>Test: delete social</p>
        <form method="post" name="form_delete" action="" onsubmit="return apiAjax('form_delete');">
            <p><input type="text" name="secret" placeholder="access token" onfocus="placeholder=''"></p>
            <p><select name="social_id">
                    <option>Выберите соцсеть</option>
                <?php if ($socials->num_rows) {
                  while ($user_soc = $socials->fetch_assoc()) { ?>
                      <option value="<?php echo hscAll($user_soc['id']); ?>"><?php echo hscAll($user_soc['name']); ?></option>
                  <?php }
                } ?>
                </select></p>
            <p><input type="text" name="format" placeholder="json" onfocus="placeholder=''"></p>
            <input type="hidden" name="delete_button">
            <p><input type="submit" value="Send"></p>
        </form>
    </div>
</div>
<div class="right_bar">
    <p>Ответ:</p>
    <p id="response"></p>
</div>
<div class="clear"></div>