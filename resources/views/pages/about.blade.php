@extends('layout')

@section('style')
@endsection

@section('text')
    <div class="container">
    <table border="0px">
        <tbody>
        <tr>
            <td width="30%">
                <div class="separator" style="clear: both; text-align: center;">
                    <div class="separator" style="clear: both; text-align: center;"><a
                            href="{{env('APP_URL').'/uploads/users/logo.jpg'}}"
                            style="margin-left: 1em; margin-right: 1em;"><img alt="Александр Сторчак" border="0"
                                                                              data-original-height="1562"
                                                                              data-original-width="2048" height="244"
                                                                              src="{{env('APP_URL').'/uploads/users/logo.jpg'}}"
                                                                              width="320"/></a></div>
                </div>
            </td>
            <td width="70%"><h3>Адрес проживания: Украина, г.Харьков</h3>
                <h3>E-mail: <a href="mailto:go280286sai@gmail.com">go280286sai@gmail.com</a></h3>
                <h3>linkedin: <a href="http://www.linkedin.com/in/go280286sai">www.linkedin.com</a></h3>
                <h3>Facebook:&nbsp;<a href="https://www.facebook.com/go280286sai">https://www.facebook.com</a></h3></td>
        </tr>
        <tr>
            <td width="30%"><h2>Навыки</h2>
                <p>- ОС Windows, ASP Linux;</p>
                <p>- HTML, CSS, JAVASCRIPT, PHP</p>
                <p>- Docker, Git</p>
                <p>- Joomla, Wordpress, Opencart</p>
                <p>- Python</p>
                <p>- Tablea</p>
                <p>- 1C программирование (junior)</p>
                <p>- Photoshop,Illustrator, Figma; </p>
                <p>- Premiere,After Effects;</p>

            </td>
            <td width="70%"><h2>Образование</h2>
                <p>2021-2022г. A-level, г.Харьков, PHP fulstack</p>
                <p>2021 - Планета знаний, г.Харьков, 1С програмирование</p>
                <p>2005-2007г. <b>Донецкая компьютерная академия «Шаг»</b>, Факультет - компьютерная графика, специалист
                    компьютерной графики и интернет технологий.<br/>Изучал 3DMax, весь Adobe(Photoshop, dreamweaver,
                    illustrator, indesign и пр.), PHP, javascript, CSS, HTML и прочее. Разработал персональную CMS для
                    агенства недвижимости "Continental".</p>
                <p>2003-2008г. <b>Автомобильно-дорожный институт Донецкого Национального Технического Университета</b>,
                    Факультет – Менеджмент организаций, стационар, специальность – Менеджер-экономист, диплом
                    специалиста</p>

                <h2>Сертификаты:</h2>
                <p>2021г. Stepic: <a href="https://stepik.org/cert/1071750">Введение в Linux</a></p>
                <p>2021г. Stepic: <a href="https://stepik.org/cert/1067709">Программирование на Python</a></p>
                <p>2020г. Stepic: <a href="https://stepik.org/cert/785674">"Поколение Python": курс для начинающих</a>
                </p>
                <p>2021г. Stepic: <a href="https://stepik.org/cert/931643">Информационные технологии. Работа с
                        электронными таблицами Excel</a></p>
                <p>2021г. Stepic: <a href="https://stepik.org/cert/928956">Jira: ведение задач на электронных досках</a>
                </p>
                <p>2019г. Stepic: <a href="https://stepik.org/cert/241009">JavaScript для начинающих</a></p>
                <p>2019г. Stepic: <a href="https://stepik.org/cert/233462">Веб-разработка для начинающих: HTML и CSS</a>
                </p>
               </td>
        </tr>
        </tbody>
    </table>
    </div>
@endsection

@section('js')
@endsection
