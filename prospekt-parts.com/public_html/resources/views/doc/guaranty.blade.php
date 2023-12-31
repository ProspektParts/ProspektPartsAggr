@extends('layout/index', [
    'title' => 'Условия гарантии | Проспект Партс',
    'keywords' => 'условие, гарантия, service, сервис, мерседес бенц, актрос',
    'description' => 'Правила возврата компании ООО '.config('app.name'),
    'image' => 'https://prospekt-parts.com/img/5464765787695.jpg'
])

@section('title', 'Условия гарантии')

@section('content')
<section class="bg-white">
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2 my-5 text">
                <h2 class="fw-bold">Условия гарантии</h2>
                <hr />
                <p><h6>1. УСЛОВИЯ ВОЗВРАТА ТОВАРА ПРИ ВЫЯВЛЕНИИ В НЕМ СКРЫТЫХ НЕДОСТАТКОВ</h6></p>
                <p>
                    <strong>1.1.</strong> Правила настоящих Условий распространяются на случаи нарушения Поставщиком условий договора 
                    поставки о качестве поставленного товара в части скрытых недостатков. Скрытые недостатки - это 
                    недостатки, которые нельзя обнаружить при обычном способе приемки, и они проявляются только в 
                    процессе установки, монтажа, эксплуатации или хранения товара.
                </p>
                <p>
                    <strong>1.2.</strong> Сроки гарантии исчисляются со дня получения товара Покупателем, если иное не предусмотрено 
                    договором поставки. Гарантийный срок на товар устанавливается Производителем или Поставщиком товара.
                </p>
                <p>
                    <strong>1.2.1.</strong> Если на товар не установлен гарантийный срок или срок годности, требования, связанные 
                    с недостатками товара, могут быть предъявлены Покупателем при условии, что недостатки проданного 
                    товара были обнаружены в разумный срок, но в пределах двух лет со дня передачи товара Покупателю, 
                    либо в пределах более длительного срока, когда такой срок установлен законом или договором 
                    купли-продажи. Срок для выявления недостатков товара, подлежащего перевозке или отправке 
                    по почте, исчисляется со дня доставки товара в место его назначения.
                </p>
                <p>
                    <strong>1.2.2.</strong> Если на товар установлен гарантийный срок, Покупатель вправе предъявить требования, 
                    связанные с недостатками товара, при обнаружении недостатков в течение гарантийного срока.
                </p>
                <p>
                    <strong>1.3.</strong> При выявлении скрытых недостатков товара возможность возврата будет рассмотрена 
                    Поставщиком только при предоставлении от Покупателя следующих документов:
                    <ul>
                        <li>Заполненного бланка рекламации на возврат;</li>
                        <li>
                            Заказ-наряд на установку (монтаж), либо на замену данной детали на транспортном средстве, 
                            выданный сертифицированной станцией технического обслуживания автомобилей (далее – СТО) 
                            или официальным дилером, копия заказа-наряда на снятие (демонтаж) товара, если неисправность 
                            обнаружена датой, отличающейся от даты монтажа, и транспортное средство (далее – ТС) 
                            эксплуатировалось, имея больший пробег от даты монтажа.
                            <br />
                            <br />
                            <i class="d-block text-muted w-100 mb-3">
                                * В заказах-нарядах должны быть указаны следующие сведения: 
                                дата заказа-наряда, пробег ТС на момент установки товара, 
                                марка и модель ТС, ФИО владельца ТС, государственный регистрационный 
                                знак (номер), тип двигателя, идентификационный номер ТС (VIN-код), 
                                номер шасси (при наличии), список выполненных работ по установке 
                                или снятию товара, список сопутствующих работ по замене товара, 
                                предписанных производителем ТС, без которых нормальная эксплуатация 
                                товара не возможна, перечень расходных материалов, требуемых 
                                производителем ТС, без которых корректный монтаж и эксплуатация товара невозможна;
                            </i>
                        </li>
                        <li>
                            Сертификат СТО, подтверждающий соответствие выполнения требований при проведении работ (если имеется);
                        </li>
                        <li>
                            Копии платежных документов по выполненным работам и расходным материалам;
                        </li>
                        <li>
                            Заключение СТО, выполненное на фирменном бланке организации.
                            <i>
                                * В заключении необходимо наличие основных данных: артикул заявленного товара, 
                                владелец/заказчик ТС, VIN код и/или гос. номер ТС, пробег ТС, описание метода 
                                обнаружения дефекта, наименование применяемого оборудования и/или специального 
                                инструмента, подробное описание дефекта заявленного товара;
                            </i>
                        </li>
                        <li>
                            Протокол диагностического оборудования, когда диагностика различных систем 
                            ТС производится только блоком управления самого ТС.
                            <i>
                                * Протокол должен содержать идентификационный номер ТС и информацию 
                                о неисправности (код ошибки, либо иное графическое отображение 
                                неправильной работы товара), допускается копия, скриншот, фотография, 
                                распечатка с экрана диагностического оборудования.
                            </i>
                        </li>
                    </ul>                    
                </p>
                <br />
                <p><h6>2. ОСОБЫЕ УСЛОВИЯ ВОЗВРАТА ТОВАРА ПО ГАРАНТИИ</h6></p>
                <p>
                    <strong>2.1.</strong> Покупатель может ознакомиться с особыми условиями по срокам гарантии на товар, 
                    установленными Производителем товара, скачать сроки гарантии.
                </p>
                <p>
                    <strong>2.2.</strong> При выявлении недостатка товара в процессе эксплуатации 
                    по торговой марке STELLOX возможность возврата товара будет 
                    рассмотрена Поставщиком по упрощенной схеме на основании 
                    заполненного бланка рекламации (скачать), без дополнительных документов от СТО.
                    <br />
                    <br />
                    <i>
                        Поставщик гарантирует Покупателю безусловную компенсацию стоимости 
                        товара без проведения диагностики и/или экспертизы или обмен на 
                        аналогичный товар в минимальные сроки с момента передачи товара 
                        на склад Поставщика, но только в том случае, если стоимость 
                        товара не превышает 25 000 российских рублей. Если стоимость 
                        товара свыше 25 000 российских рублей, то возможность возврата 
                        товара будет рассмотрена Поставщиком после предоставления 
                        Покупателем полного комплекта документов, указанных в п.1.3 настоящих Условий.
                    </i>
                </p>
                <p>
                    <strong>2.3.</strong> При выявлении недостатка товара в процессе эксплуатации по торговой 
                    марке Zentparts возможность возврата будет рассмотрена поставщиком по 
                    стандартной процедуре при предъявлении документов, указанных в п. 1.3. 
                    Гарантия на легковой ассортимент составляет 24 месяца, на грузовой 
                    ассортимент 12 месяцев с момента продажи.
                </p>
                <p>
                    <strong>2.4.</strong> При выявлении недостатка товара торговой марки EDCON возможность 
                    возврата товара будет рассмотрена Поставщиком по упрощенной схеме на 
                    основании заполненного бланка рекламации, без дополнительных документов от СТО.
                </p>
                <p>
                    <strong>2.5.</strong> При выявлении недостатка товара торговой марки Wezer возможность возврата 
                    товара будет рассмотрена Поставщиком на основании заполненной карты диагностики 
                    Wezer.
                </p>
                <p>
                    <strong>2.6.</strong> При выявлении недостатка товара в процессе эксплуатации по торговой 
                    марке BOSCH возможность возврата товара будет рассмотрена поставщиком по 
                    стандартной процедуре с предъявлением документов, указанных в п. 1.3., 
                    а также при наличии заполненного гарантийного талона BOSCH.
                    <br />
                    <br />
                    <i>
                        При возврате аккумуляторов  BOSCH в гарантийном случае действует 
                        стандартная приема бракованного товара через Поставщика, у которого 
                        покупался товар, т.к. авторизованные Бош-сервисы не занимаются 
                        гарантийным обслуживанием аккумуляторов и не дают экспертную оценку по рекламации.
                    </i>
                </p>
                <p>
                    <strong>2.6.1.</strong> Информация о гарантийных талонах BOSCH.
                    <ul>
                        <li>
                            Отгрузка напечатанных типографским способом гарантийных талонов 
                            для автозапчастей BOSCH прекращена. Электронная версия гарантийного 
                            талона доступна для скачивания — скачать гарантийный талон.
                        </li>
                        <li>
                            Электронная версия гарантийного талона не применяется на аккумуляторы BOSCH. 
                            Гарантийные талоны на аккумуляторы BOSCH Поставщик прикладывает к товару при 
                            продаже его Покупателю.
                        </li>
                        <li>
                            В случае отсутствия гарантийного талона Покупатель должен запросить его допоставку 
                            у Поставщика. Поставщик обязан со следующей партией товара передать необходимое 
                            количество гарантийных талонов Покупателю.
                        </li>
                    </ul>
                </p>
                <p>
                    <strong>2.7.</strong> Для возврата товара ненадлежащего качества торговых марок SAF-HOLLAND и SAUER 
                    необходимо обратиться за диагностикой вышедшего из строя узла, электронных 
                    компонентов полуприцепа и иного товара в ближайшую сервисную станцию SAF. 
                    Список сервисных станций можно скачать на сайте, скачать список сервисных станций SAF
                    <ul>
                        <li>
                            После проведения проверки, если дефект товара признается не гарантийным, 
                            Покупатель обязан оплатить проведенную диагностику по тарифу сервисного партнера SAF.
                        </li>
                        <li>
                            Если дефект товара признается гарантийным, Покупатель получает диагностическое 
                            заключение. С диагностическим заключением Покупатель обращается к Поставщику, 
                            у которого был ранее приобретен товар, и может получить взамен новое изделие 
                            (при наличии на складе) или денежные средства за товар.
                        </li>
                    </ul>
                </p>
                <p>
                    <strong>2.8.</strong> Отсутствие какого-либо из вышеуказанных документов, а равно их ненадлежащее, 
                    некорректное, противоречивое заполнение влечет за собой отказ в возврате товара.
                </p>
                <p>
                    <strong>2.9.</strong> Поставщик вправе запросить у Покупателя дополнительные документы 
                    при возникновении сомнений в достоверности предоставленных данных.
                    <br />
                    <br />
                    <i>
                        Если Покупатель в течение 30 дней с момента запроса Поставщика не предоставит 
                        требуемые документы в полном объеме, то Поставщик вправе отказать в рассмотрении 
                        рекламации и вернуть товар Покупателю.
                    </i>
                </p>
                <br />
                <p><h6>3. ПОРЯДОК ПОДАЧИ РЕКЛАМАЦИЙ ПО ГАРАНТИИ НА ТОВАР</h6></p>
                <p>
                    <strong>3.1.</strong> Для рассмотрения рекламаций по скрытым недостаткам товара, Покупателю 
                    необходимо оформить заявку на сайте Поставщика через форму «Оформление рекламации», 
                    либо написать на электронную почту в отдел рекламаций Поставщика, приложив 
                    описание возникшей рекламации, необходимые скан-копии документов, указанных 
                    в разделах 1 и 2 настоящих Условий и фотографии рекламационного товара. 
                    Единая электронная почта отдела рекламаций: service@prospekt-parts.com
                </p>
                <p>
                    <strong>3.2.</strong> Срок рассмотрения рекламаций по скрытым недостаткам товара составляет 
                    до 20 календарных дней с момента получения всех необходимых документов в 
                    корректной форме и запрошенных специалистом отдела рекламаций фотографий.
                    <ul>
                        <li>
                            В случае возникновения необходимости в дополнительной проверке и диагностике 
                            некачественного товара, срок рассмотрения рекламации может быть увеличен 
                            Поставщиком в одностороннем порядке.
                        </li>
                        <li>
                            Если в результате проверки качества товара и/или диагностики будет установлено, 
                            что ненадлежащее качество товара является результатом не скрытых заводских дефектов, 
                            а следствием каких-либо иных причин, за которые не отвечает Поставщик, товар к возврату 
                            не принимается и подлежит отправке Покупателю за его счёт. При этом все издержки по 
                            проведению проверки качества и/или диагностики товара, которые понес Поставщик, 
                            возлагаются на Покупателя.
                        </li>
                    </ul>
                </p>
                <p>
                    <strong>3.3.</strong> Поставщик в рамках лояльности может рассмотреть претензию Покупателя 
                    в минимальный срок, в случае, если Покупатель приобретал товар из наличия 
                    склада Поставщика, и Покупатель при выставлении рекламации в адрес Поставщика, 
                    вместе с документами по рекламационному товару, приложил заполненное соглашение 
                    об урегулировании претензии.
                    <br />
                    <br />
                    <i>
                        Скачать соглашение об урегулировании претензии можно на сайте, 
                        <a href="#">скачать соглашение для юридического лица.</a> 
                    </i>
                </p>
                <p>
                    <strong>3.4.</strong> Поставщик оставляет за собой право рассмотрения рекламации по приложенным 
                    фотографиям и документам от Покупателя без фактического перемещения 
                    товара на склад Поставщика.
                </p>
                <br />
                <p><h6>4. ОБСТОЯТЕЛЬСТВА, ИСКЛЮЧАЮЩИЕ ГАРАНТИЮ НА ТОВАР</h6> </p>
                <p>4.1. Нарушение вышеизложенных пунктов настоящих Условий.</p>
                <p>
                    <strong>4.2.</strong>  Гарантия не распространяется на товар при эксплуатационном износе, а именно на:
                    <ul>
                        <li>Автостекла;</li>
                        <li>Автомобильные лампы;</li>
                        <li>Кузовные детали;</li>
                        <li>Пластиковые детали;</li>
                        <li>Технические жидкости;</li>
                        <li>Щетки стеклоочистителей;</li>
                        <li>Тормозные колодки;</li>
                        <li>Фильтры.</li>
                    </ul>
                </p>
                <p>
                    <strong>4.3.</strong>  Гарантия не распространяется на товар в следующих случаях:
                    <ul>
                        <li>Повреждение запасной части в результате ДТП или небрежной эксплуатации;</li>
                        <li>
                            Неисправности запасных частей топливной системы и системы выпуска вследствие 
                            применения некачественного топлива (в том числе из-за загрязнения или применения 
                            этилированного бензина);
                        </li>
                        <li>
                            Повреждения (в том числе подвески и рулевого управления), возникшие из-за 
                            неаккуратного вождения на неровностях дорог, сопряженного с ударными нагрузками на автомобиль;
                        </li>
                        <li>
                            Незначительные отклонения, не влияющие на качество, характеристики или 
                            работоспособность автомобиля, или его элементов 
                            (например, слабый шум, скрип, писк или вибрация);
                        </li>
                        <li>Внешние повреждения стекол кузова и приборов освещения;</li>
                        <li>
                            Замененные не в паре детали ходовой части автомобиля 
                            (пружины, амортизаторы, стойки стабилизатора); 
                            амортизаторы, замененные в количестве менее 2 (двух) 
                            штук на одну ось автомобиля и без замены защитных 
                            комплектов (отбойник плюс пыльник);
                        </li>
                        <li>
                            Нарушение гарантийных пломб, механическое повреждение 
                            и вскрытие рекламационного товара;
                        </li>
                        <li>
                            Возврат неполного комплекта товара, без частей которого невозможно 
                            провести оценку наличия производственного дефекта.
                        </li>
                    </ul>
                </p>
                <br />
                <p><h6>5. ОБРАЩЕНИЕ К РУКОВОДИТЕЛЮ ОТДЕЛА</h6> </p>
                <p>
                    <strong>5.1.</strong>  Если Покупатель хочет поблагодарить или пожаловаться на обслуживание, 
                    оставить свой отзыв по улучшению работы, для этого необходимо написать 
                    письмо в адрес руководителя отдела рекламаций на e-mail info@prospekt-parts.com
                </p>
                
                <hr class="py-4" />
                <p class="text-center"><a href="/doc" class="btn btn-dark px-4">Юридическая информация</a></p>
            </div>
        </div>
    </div>
</section>
@endsection