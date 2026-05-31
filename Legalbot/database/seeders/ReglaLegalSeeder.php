<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReglaLegalSeeder extends Seeder
{
    public function run(): void
    {
        // 🚨 LIMPIEZA SEGURA: Vacía solo estas dos tablas antes de sembrar para evitar duplicados
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;'); 
        DB::table('regla_legal')->truncate();
        DB::table('categoria_legal')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

        // =========================================================================
        // SECCIÓN 1: DERECHO CIVIL (PROPIEDAD Y ARRENDAMIENTO)
        // =========================================================================
        $categoriaCivilId = DB::table('categoria_legal')->insertGetId([
            'nombre' => 'Derecho Civil y Arrendamiento',
            'descripcion' => 'Normativas del Código Civil sobre contratos de alquiler, vivienda y propiedad.'
        ]);

        DB::table('regla_legal')->insert([
            [
                'titulo' => 'Definición del contrato de arrendamiento',
                'ley_referencia' => 'Código Civil de El Salvador',
                'articulo' => 'Artículo 1703',
                'descripcion' => 'El arrendamiento es un contrato en que las dos partes se obligan recíprocamente, la una a conceder el goce de una cosa, o a ejecutar una obra o prestar un servicio, y la otra a pagar por este goce, obra o servicio un precio determinado.',
                'categoria_id' => $categoriaCivilId,
                'vigente' => 1,
            ],
            [
                'titulo' => 'Obligaciones principales del arrendador o dueño',
                'ley_referencia' => 'Código Civil de El Salvador',
                'articulo' => 'Artículo 1712',
                'descripcion' => 'El arrendador está obligado, en general, a entregar al arrendatario la cosa arrendada, a mantenerla en estado de servir para el fin a que ha sido arrendada, y a librar al arrendatario de toda turbación o embarazo en el goce de la cosa arrendada.',
                'categoria_id' => $categoriaCivilId,
                'vigente' => 1,
            ],
            [
                'titulo' => 'Estado de entrega y reparaciones de la propiedad',
                'ley_referencia' => 'Código Civil de El Salvador',
                'articulo' => 'Artículo 1715',
                'descripcion' => 'El arrendador es obligado a hacer todas las reparaciones necesarias en la cosa arrendada, a excepción de las locativas, las cuales corresponden generalmente al arrendatario. Sin embargo, el arrendador será obligado a las reparaciones locativas si los daños provienen de fuerza mayor o caso fortuito, o de la mala calidad de la cosa arrendada.',
                'categoria_id' => $categoriaCivilId,
                'vigente' => 1,
            ],
            [
                'titulo' => 'Obligación del inquilino de pagar el alquiler o renta',
                'ley_referencia' => 'Código Civil de El Salvador',
                'articulo' => 'Artículo 1721',
                'descripcion' => 'El arrendatario es obligado a pagar el precio o renta en los plazos convenidos. Si no hay convención, se seguirá la costumbre del lugar. A falta de costumbre, la renta de casas se pagará por meses, y la de predios rústicos por años.',
                'categoria_id' => $categoriaCivilId,
                'vigente' => 1,
            ],
            [
                'titulo' => 'Cuidado y responsabilidad del inquilino sobre el bien',
                'ley_referencia' => 'Código Civil de El Salvador',
                'articulo' => 'Artículo 1726',
                'descripcion' => 'El arrendatario empleará en el cuidado de la cosa el cuidado de un buen padre de familia. Responderá de los perjuicios que por su culpa o la de sus dependientes, huéspedes o subarrendatarios, se causaren en la cosa arrendada.',
                'categoria_id' => $categoriaCivilId,
                'vigente' => 1,
            ],
            [
                'titulo' => 'Prohibición de subarrendar sin autorización',
                'ley_referencia' => 'Código Civil de El Salvador',
                'articulo' => 'Artículo 1731',
                'descripcion' => 'El arrendatario no tiene la facultad de ceder el arriendo ni de subarrendar, a menos que se le haya expresamente concedido; pero en este caso no podrá el cesionario o subarrendatario usar de la cosa en otros términos que los estipulados con el arrendatario primordial.',
                'categoria_id' => $categoriaCivilId,
                'vigente' => 1,
            ],
            [
                'titulo' => 'Restitución y devolución de la cosa arrendada',
                'ley_referencia' => 'Código Civil de El Salvador',
                'articulo' => 'Artículo 1735',
                'descripcion' => 'El arrendatario es obligado a restituir la cosa al fin del arrendamiento. Deberá restituirla en el estado en que le fue entregada, tomándose en consideración el deterioro natural por el uso legítimo de la cosa.',
                'categoria_id' => $categoriaCivilId,
                'vigente' => 1,
            ],
            [
                'titulo' => 'Terminación del contrato por expiración del plazo',
                'ley_referencia' => 'Código Civil de El Salvador',
                'articulo' => 'Artículo 1738',
                'descripcion' => 'El arrendamiento de cosas expira universalmente por la expiración del plazo fijado por la convención de las partes, o por la ley, o por el desahucio en los casos en que la ley lo requiere.',
                'categoria_id' => $categoriaCivilId,
                'vigente' => 1,
            ],
            [
                'titulo' => 'Terminación por destrucción o mal estado de la cosa',
                'ley_referencia' => 'Código Civil de El Salvador',
                'articulo' => 'Artículo 1741',
                'descripcion' => 'El arrendamiento expira asimismo por la destrucción total de la cosa arrendada, o por su mal estado o calidad que impida hacer de ella el uso para que fue arrendada, teniendo derecho el arrendatario a la rescisión del contrato.',
                'categoria_id' => $categoriaCivilId,
                'vigente' => 1,
            ],
            [
                'titulo' => 'Mora en el pago y derecho de retención del arrendador',
                'ley_referencia' => 'Código Civil de El Salvador',
                'articulo' => 'Artículo 1745',
                'descripcion' => 'Si el arrendatario se constituye en mora de pagar la renta por dos períodos consecutivos, el arrendador tendrá derecho a solicitar la terminación del contrato y la desocupación inmediata del inmueble, respondiendo el arrendatario por los daños.',
                'categoria_id' => $categoriaCivilId,
                'vigente' => 1,
            ]
        ]);

        // =========================================================================
        // SECCIÓN 2: DERECHO LABORAL (CÓDIGO DE TRABAJO DE EL SALVADOR)
        // =========================================================================
        $categoriaLaboralId = DB::table('categoria_legal')->insertGetId([
            'nombre' => 'Derecho Laboral',
            'descripcion' => 'Leyes y normativas sobre contratos de trabajo, jornadas, prestaciones, despidos y renuncias.'
        ]);

        DB::table('regla_legal')->insert([
            [
                'titulo' => 'Indemnización por despido injustificado',
                'ley_referencia' => 'Código de Trabajo de El Salvador',
                'articulo' => 'Artículo 58',
                'descripcion' => 'Cuando un trabajador contratado por tiempo indefinido es despedido de sus labores sin causa justificada, el patrono está obligado a pagarle una indemnización equivalente al salario de quince días por cada año de servicio prestado, y proporcionalmente por fracciones de año.',
                'categoria_id' => $categoriaLaboralId,
                'vigente' => 1,
            ],
            [
                'titulo' => 'Cálculo y derecho del Aguinaldo Anual',
                'ley_referencia' => 'Código de Trabajo de El Salvador',
                'articulo' => 'Artículo 198',
                'descripcion' => 'Los patronos están obligados a pagar a sus trabajadores una prima en concepto de aguinaldo por cada año de trabajo. El pago completo se calcula según la antigüedad: de 1 a 3 años corresponden 15 días de salario; de 3 a 10 años corresponden 19 días de salario; y de 10 o más años corresponden 21 días de salario básico.',
                'categoria_id' => $categoriaLaboralId,
                'vigente' => 1,
            ],
            [
                'titulo' => 'Período obligatorio para el pago del aguinaldo',
                'ley_referencia' => 'Código de Trabajo de El Salvador',
                'articulo' => 'Artículo 200',
                'descripcion' => 'La prima en concepto de aguinaldo debe ser pagada obligatoriamente por el patrono en el período comprendido entre el doce y el veinte de diciembre de cada año.',
                'categoria_id' => $categoriaLaboralId,
                'vigente' => 1,
            ],
            [
                'titulo' => 'Vacación Anual Remunerada y recargo obligatorio',
                'ley_referencia' => 'Código de Trabajo de El Salvador',
                'articulo' => 'Artículo 177',
                'descripcion' => 'Después de un año de trabajo continuo en la misma empresa, el trabajador tiene derecho a un período de vacaciones que durará quince días, los cuales serán totalmente remunerados con el salario básico correspondiente a dicho período más un recargo obligatorio del treinta por ciento (30%) del mismo.',
                'categoria_id' => $categoriaLaboralId,
                'vigente' => 1,
            ],
            [
                'titulo' => 'Jornada laboral ordinaria diurna y nocturna',
                'ley_referencia' => 'Código de Trabajo de El Salvador',
                'articulo' => 'Artículo 161',
                'descripcion' => 'La jornada ordinaria de trabajo efectivo diurno no podrá exceder de ocho horas diarias ni de cuarenta y cuatro horas semanales. La jornada ordinaria de trabajo efectivo nocturno no podrá exceder de siete horas diarias ni de treinta y mias semanales.',
                'categoria_id' => $categoriaLaboralId,
                'vigente' => 1,
            ],
            [
                'titulo' => 'Licencia por maternidad y subsidio económico',
                'ley_referencia' => 'Código de Trabajo de El Salvador',
                'articulo' => 'Artículo 309',
                'descripcion' => 'El patrono está obligado a conceder a la trabajadora una licencia por maternidad de dieciséis semanas, de las cuales diez se tomarán obligatoriamente después del parto. Durante este período, el patrono debe pagar un subsidio económico equivalente al 100% del salario si la trabajadora no está cubierta por el Seguro Social.',
                'categoria_id' => $categoriaLaboralId,
                'vigente' => 1,
            ],
            [
                'titulo' => 'Garantía de estabilidad laboral por embarazo',
                'ley_referencia' => 'Código de Trabajo de El Salvador',
                'articulo' => 'Artículo 113',
                'descripcion' => 'Desde que comienza el estado de gravidez o embarazo, y hasta que concluya la licencia de maternidad, el despido de hecho o la notificación de despido hecha por el patrono no producirá la terminación del contrato de trabajo, salvo que haya causa justa calificada previamente por un juez.',
                'categoria_id' => $categoriaLaboralId,
                'vigente' => 1,
            ],
            [
                'titulo' => 'Prestación económica por renuncia voluntaria',
                'ley_referencia' => 'Ley Reguladora de la Prestación Económica por Renuncia Voluntaria',
                'articulo' => 'Artículo 1',
                'descripcion' => 'Los trabajadores que presenten su renuncia voluntaria de forma escrita y con el preaviso que manda la ley, tienen derecho a recibir una prestación económica equivalente al salario de quince días por cada año de servicio, calculada sobre la base del salario mínimo correspondiente.',
                'categoria_id' => $categoriaLaboralId,
                'vigente' => 1,
            ],
            [
                'titulo' => 'Obligación del preaviso en caso de renuncia',
                'ley_referencia' => 'Ley Reguladora de la Prestación Económica por Renuncia Voluntaria',
                'articulo' => 'Artículo 9',
                'descripcion' => 'Para tener derecho a la prestación económica por renuncia, el trabajador deberá dar un preaviso por escrito al patrono con una anticipación mínima de quince días si es personal directivo o técnico, y de ocho días para los demás trabajadores.',
                'categoria_id' => $categoriaLaboralId,
                'vigente' => 1,
            ],
            [
                'titulo' => 'Prohibición de retención de salarios por el patrono',
                'ley_referencia' => 'Código de Trabajo de El Salvador',
                'articulo' => 'Artículo 30',
                'descripcion' => 'Se prohíbe terminantemente a los patronos hacer retenciones, deducciones o descuentos del salario de los trabajadores, salvo los autorizados por la ley (ISSS, AFP, Renta) o por orden judicial específica.',
                'categoria_id' => $categoriaLaboralId,
                'vigente' => 1,
            ]
        ]);

        // =========================================================================
        // SECCIÓN 3: DERECHO CONSTITUCIONAL (CONSTITUCIÓN DE EL SALVADOR)
        // =========================================================================
        $categoriaConstId = DB::table('categoria_legal')->insertGetId([
            'nombre' => 'Derecho Constitucional',
            'descripcion' => 'Derechos fundamentales, garantías individuales, principios de igualdad y organización del Estado.'
        ]);

        DB::table('regla_legal')->insert([
            [
                'titulo' => 'El origen y fin del Estado: La Persona Humana',
                'ley_referencia' => 'Constitución de la República de El Salvador',
                'articulo' => 'Artículo 1',
                'descripcion' => 'El Salvador reconoce a la persona humana como el origen y el fin de la actividad del Estado, que está organizado para la consecución de la justicia, de la seguridad jurídica y del bien común. Es obligación del Estado asegurar a los habitantes de la República, el goce de la libertad, la salud, la cultura, el bienestar económico y la justicia social.',
                'categoria_id' => $categoriaConstId,
                'vigente' => 1,
            ],
            [
                'titulo' => 'Derecho a la vida, integridad y libertad',
                'ley_referencia' => 'Constitución de la República de El Salvador',
                'articulo' => 'Artículo 2',
                'descripcion' => 'Toda persona tiene derecho a la vida, a la integridad física y moral, a la libertad, a la seguridad, al trabajo, a la propiedad y posesión, y a ser protegida en la conservación y defense de los mismos. Se establece el derecho al honor, a la intimidad personal y familiar y a la propia imagen.',
                'categoria_id' => $categoriaConstId,
                'vigente' => 1,
            ],
            [
                'titulo' => 'Principio de igualdad y prohibición de discriminación',
                'ley_referencia' => 'Constitución de la República de El Salvador',
                'articulo' => 'Artículo 3',
                'descripcion' => 'Todas las personas son iguales ante la ley. Para el goce de los derechos civiles no podrán establecerse restricciones que se basen en diferencias de nacionalidad, raza, sexo o religión. No se reconocen empleos ni privilegios hereditarios.',
                'categoria_id' => $categoriaConstId,
                'vigente' => 1,
            ],
            [
                'titulo' => 'Libertad de circulación y derecho a no ser expatriado',
                'ley_referencia' => 'Constitución de la República de El Salvador',
                'articulo' => 'Artículo 5',
                'descripcion' => 'Toda persona tiene libertad de entrar, de permanecer en el territorio de la República y salir de él, salvo las limitaciones que la ley establezca. Nadie puede ser obligado a mudar de domicilio o residencia, sino por mandato de autoridad judicial en los casos especiales y con los requisitos que la ley señale. Ningún salvadoreño podrá ser expatriado, ni prohibírsele la entrada en el territorio de la República, ni negársele pasaporte para su regreso u otros documentos de identificación.',
                'categoria_id' => $categoriaConstId,
                'vigente' => 1,
            ],
            [
                'titulo' => 'Libertad de expresión y de prensa',
                'ley_referencia' => 'Constitución de la República de El Salvador',
                'articulo' => 'Artículo 6',
                'descripcion' => 'Toda persona puede expresar y difundir libremente sus pensamientos siempre que no subvierta el orden público, ni lesione la moral, el honor, ni la vida privada de los demás. El ejercicio de este derecho no estará sujeto a previo examen, censura ni caución; pero los que haciendo uso de él infrinjan las leyes, responderán por el delito que cometan.',
                'categoria_id' => $categoriaConstId,
                'vigente' => 1,
            ],
            [
                'titulo' => 'Libertad de asociación y reunión pacífica',
                'ley_referencia' => 'Constitución de la República de El Salvador',
                'articulo' => 'Artículo 7',
                'descripcion' => 'Los habitantes de El Salvador tienen derecho a asociarse libremente y a reunirse pacíficamente y sin armas para cualquier objeto lícito. Nadie podrá ser obligado a pertenecer a una asociación. Se prohíbe la existencia de asociaciones armadas, de carácter militar o paramilitar.',
                'categoria_id' => $categoriaConstId,
                'vigente' => 1,
            ],
            [
                'titulo' => 'Derecho de opción y libertad para contratar',
                'ley_referencia' => 'Constitución de la República de El Salvador',
                'articulo' => 'Artículo 23',
                'descripcion' => 'Se garantiza la libertad para contratar conforme a las leyes. Ninguna persona que tenga la libre administración de sus bienes puede ser privada del derecho de terminar sus asuntos civiles o comerciales por transacción o arbitramento. Ninguna ley puede limitar o restringir la libertad de contratar sobre asuntos lícitos.',
                'categoria_id' => $categoriaConstId,
                'vigente' => 1,
            ],
            [
                'titulo' => 'Libertad de conciencia y religión',
                'ley_referencia' => 'Constitución de la República de El Salvador',
                'articulo' => 'Artículo 25',
                'descripcion' => 'Se garantiza el libre ejercicio de todas las religiones, sin más límite que el trazado por la moral y el orden público. Ningún acto religioso servirá para establecer el estado civil de las personas.',
                'categoria_id' => $categoriaConstId,
                'vigente' => 1,
            ],
            [
                'titulo' => 'El Habeas Corpus o Exhibición Personal',
                'ley_referencia' => 'Constitución de la República de El Salvador',
                'articulo' => 'Artículo 11',
                'descripcion' => 'Ninguna persona puede ser privada de su vida y libertad sin ser previamente oída y vencida en juicio conforme a las leyes. Toda persona que considere que su libertad está siendo restringida de forma ilegal, tiene derecho a interponer el recurso de Habeas Corpus ante la Sala de lo Constitucional o cámaras de segunda instancia para que se verifique de inmediato su situación.',
                'categoria_id' => $categoriaConstId,
                'vigente' => 1,
            ],
            [
                'titulo' => 'Garantía del debido proceso y presunción de inocencia',
                'ley_referencia' => 'Constitución de la República de El Salvador',
                'articulo' => 'Artículo 12',
                'descripcion' => 'Toda persona acusada de delito se presume inocente mientras no se pruebe su culpabilidad conforme a la ley y en juicio público en el que se le hayan asegurado todas las garantías necesarias para su defensa. La persona detenida debe ser informada de manera inmediata y comprensible de sus derechos y de las razones de su detención.',
                'categoria_id' => $categoriaConstId,
                'vigente' => 1,
            ],
            [
                'titulo' => 'Garantías de la detención administrativa',
                'ley_referencia' => 'Constitución de la República de El Salvador',
                'articulo' => 'Artículo 13',
                'descripcion' => 'Ningún órgano gubernamental, autoridad o funcionario podrá dictar orden de detención o prisión si no es de conformidad con la ley, y estas órdenes deberán ser siempre escritas. La detención administrativa no excederá de setenta y dos horas, dentro de las cuales deberá consignarse al detenido a la autoridad judicial competente.',
                'categoria_id' => $categoriaConstId,
                'vigente' => 1,
            ],
            [
                'titulo' => 'Prohibición de la prisión por deudas y tormento',
                'ley_referencia' => 'Constitución de la República de El Salvador',
                'articulo' => 'Artículo 27',
                'descripcion' => 'Se prohíbe la pena de muerte, salvo en los casos previstos por las leyes militares durante el estado de guerra internacional. Se prohíbe la prisión por deudas, las penas perpetuas, la infamia, las penas proscritas y toda especie de tormento o tratos crueles.',
                'categoria_id' => $categoriaConstId,
                'vigente' => 1,
            ],
            [
                'titulo' => 'Derecho de petición y respuesta oportuna',
                'ley_referencia' => 'Constitución de la República de El Salvador',
                'articulo' => 'Artículo 18',
                'descripcion' => 'Toda persona tiene derecho a dirigir sus peticiones por escrito, de manera decorosa, a las autoridades legalmente constituidas; a que se le resuelvan, y a que se le haga saber lo resuelto.',
                'categoria_id' => $categoriaConstId,
                'vigente' => 1,
            ],
            [
                'titulo' => 'Inviolabilidad de la morada y del hogar',
                'ley_referencia' => 'Constitución de la República de El Salvador',
                'articulo' => 'Artículo 20',
                'descripcion' => 'La morada es inviolable. Solo podrá ingresarse a ella por consentimiento de la persona que la habita, por mandato judicial, por flagrante delito o peligro inminente de su perpetración, o por graves motivos de salubridad pública.',
                'categoria_id' => $categoriaConstId,
                'vigente' => 1,
            ],
            [
                'titulo' => 'Inviolabilidad de las comunicaciones',
                'ley_referencia' => 'Constitución de la República de El Salvador',
                'articulo' => 'Artículo 24',
                'descripcion' => 'La correspondencia de toda clase es inviolable. Los documentos epistolares, telegráficos, telefónicos o de cualquier otra especie de comunicación intervenidos o incautados sin los requisitos legales no producirán fe ni fe pública en juicio. La ley determinará las intervenciones autorizadas judicialmente.',
                'categoria_id' => $categoriaConstId,
                'vigente' => 1,
            ],
            [
                'titulo' => 'Régimen de Excepción y suspensión de garantías',
                'ley_referencia' => 'Constitución de la República de El Salvador',
                'articulo' => 'Artículo 29',
                'descripcion' => 'En casos de guerra, invasión del territorio, rebelión, sedición, catástrofe, epidemia u otra calamidad general, o de graves perturbaciones del orden público, podrán suspenderse las garantías contempladas en los artículos 5, 6 inciso primero, 7 inciso primero y 24 de esta Constitución, excepto en lo relativo a reuniones con fines religiosos o culturales.',
                'categoria_id' => $categoriaConstId,
                'vigente' => 1,
            ],
            [
                'titulo' => 'Fundamento familiar y protección del matrimonio',
                'ley_referencia' => 'Constitución de la República de El Salvador',
                'articulo' => 'Artículo 32',
                'descripcion' => 'La familia es la base fundamental de la sociedad y tendrá la protección del Estado, quien dictará las leyes necesarias y creará los organismos para su integración, bienestar y desarrollo social, cultural y económico. El fundamento legal de la familia es el matrimonio.',
                'categoria_id' => $categoriaConstId,
                'vigente' => 1,
            ],
            [
                'titulo' => 'Igualdad de los hijos y derecho a la identidad',
                'ley_referencia' => 'Constitución de la República de El Salvador',
                'articulo' => 'Artículo 36',
                'descripcion' => 'Los hijos nacidos dentro o fuera de matrimonio y los adoptivos, tienen iguales derechos frente a sus padres. Es obligación de estos dar a sus hijos protección, asistencia, educación y seguridad. Toda persona tiene derecho a un nombre y a saber quiénes son sus padres.',
                'categoria_id' => $categoriaConstId,
                'vigente' => 1,
            ],
            [
                'titulo' => 'Protección constitucional al trabajo',
                'ley_referencia' => 'Constitución de la República de El Salvador',
                'articulo' => 'Artículo 37',
                'descripcion' => 'El trabajo es una función social, goza de la protección del Estado y no se considera artículo de comercio. El Estado empleará todos los recursos que estén a su alcance para proporcionar ocupación al trabajador, manual o intelectual, y para asegurar a él y a su familia las condiciones económicas de una existencia digna.',
                'categoria_id' => $categoriaConstId,
                'vigente' => 1,
            ],
            [
                'titulo' => 'Derecho a la sindicación obligatoria',
                'ley_referencia' => 'Constitución de la República de El Salvador',
                'articulo' => 'Artículo 47',
                'descripcion' => 'Los patronos y trabajadores privados, sin distinción de nacionalidad, sexo, raza, credo o ideas políticas, tienen el derecho de asociarse libremente para la defensa de sus respectivos intereses, formando asociaciones profesionales o sindicatos. Tienen el mismo derecho los trabajadores de las instituciones oficiales autónomas.',
                'categoria_id' => $categoriaConstId,
                'vigente' => 1,
            ],
            [
                'titulo' => 'Derecho a la huelga y al paro',
                'ley_referencia' => 'Constitución de la República de El Salvador',
                'articulo' => 'Artículo 48',
                'descripcion' => 'Se reconoce el derecho de los trabajadores a la huelga y el de los patronos al paro. La ley regulará el ejercicio de estos derechos, fijando las condiciones y formalidades necesarias para asegurar el orden legal de los procedimientos.',
                'categoria_id' => $categoriaConstId,
                'vigente' => 1,
            ],
            [
                'titulo' => 'Derecho a la educación y acceso gratuito',
                'ley_referencia' => 'Constitución de la República de El Salvador',
                'articulo' => 'Artículo 56',
                'descripcion' => 'Todos los habitantes de la República tienen el derecho y el deber de recibir educación parvularia y básica, que los capacite para desempeñarse como ciudadanos útiles. La educación impartida en los centros oficiales será gratuita.',
                'categoria_id' => $categoriaConstId,
                'vigente' => 1,
            ],
            [
                'titulo' => 'Libertad de cátedra y fines de la educación',
                'ley_referencia' => 'Constitución de la República de El Salvador',
                'articulo' => 'Artículo 55',
                'descripcion' => 'La educación tiene por fin lograr el desarrollo integral de la personalidad en su dimensión espiritual, moral y social; contribuir a la construcción de una sociedad democrática más justa y humana. Se garantiza la libertad de cátedra.',
                'categoria_id' => $categoriaConstId,
                'vigente' => 1,
            ],
            [
                'titulo' => 'Derecho a la salud y bien público',
                'ley_referencia' => 'Constitución de la República de El Salvador',
                'articulo' => 'Artículo 65',
                'descripcion' => 'La salud de los habitantes de la República constituye un bien público. El Estado y las personas están obligados a velar por su conservación y restablecimiento. El Estado determinará la política nacional de salud y controlará la calidad de los productos químicos, farmacéuticos y biológicos.',
                'categoria_id' => $categoriaConstId,
                'vigente' => 1,
            ],
            [
                'titulo' => 'El agua como bien público y derecho humano',
                'ley_referencia' => 'Constitución de la República de El Salvador',
                'articulo' => 'Artículo 69',
                'descripcion' => 'Es obligación del Estado proveer políticas públicas que aseguren la salud y el bienestar de los habitantes. El agua limpia y el saneamiento se reconocen explícitamente como un derecho humano fundamental. El Estado debe garantizar el acceso al agua potable de forma prioritaria para el consumo humano y de las comunidades.',
                'categoria_id' => $categoriaConstId,
                'vigente' => 1,
            ],
            [
                'titulo' => 'Protección al medio ambiente y equilibrio ecológico',
                'ley_referencia' => 'Constitución de la República de El Salvador',
                'articulo' => 'Artículo 117',
                'descripcion' => 'Es deber del Estado proteger los recursos naturales, así como la diversidad e integridad del medio ambiente, para garantizar el desarrollo sostenible. Se declara de interés social la protección, conservación, aprovechamiento racional, restauración o sustitución de los recursos naturales.',
                'categoria_id' => $categoriaConstId,
                'vigente' => 1,
            ],
            [
                'titulo' => 'Derecho a la propiedad privada y función social',
                'ley_referencia' => 'Constitución de la República de El Salvador',
                'articulo' => 'Artículo 22',
                'descripcion' => 'Se garantiza la propiedad privada en función social. Toda persona tiene derecho a disponer libremente de sus bienes conforme a las leyes. La expropiación procederá únicamente por causas de utilidad pública o de interés social legalmente comprobados, y previa una justa indemnización.',
                'categoria_id' => $categoriaConstId,
                'vigente' => 1,
            ],
            [
                'titulo' => 'El Recurso de Amparo Constitucional',
                'ley_referencia' => 'Constitución de la República de El Salvador',
                'articulo' => 'Artículo 247',
                'descripcion' => 'Toda persona puede pedir amparo ante la Sala de lo Constitucional de la Corte Suprema de Justicia por violación de los derechos que le otorga la presente Constitución. El amparo protege contra actos de cualquier autoridad o funcionario que vulneren las garantías fundamentales fuera del marco legal.',
                'categoria_id' => $categoriaConstId,
                'vigente' => 1,
            ]
        ]);

        // =========================================================================
        // SECCIÓN 4: FISCALIZACIÓN Y CONTROL (LEY DE LA CORTE DE CUENTAS)
        // =========================================================================
        $categoriaFiscalId = DB::table('categoria_legal')->insertGetId([
            'nombre' => 'Derecho Administrativo y Fiscalización',
            'descripcion' => 'Leyes de control gubernamental, auditoría de fondos públicos, transparencia y sanciones a funcionarios.'
        ]);

        DB::table('regla_legal')->insert([
            [
                'titulo' => 'Naturaleza y objeto de la Corte de Cuentas',
                'ley_referencia' => 'Ley de la Corte de Cuentas de la República',
                'articulo' => 'Artículo 1',
                'descripcion' => 'La presente Ley tiene por objeto regular la organización, atribuciones y funcionamiento de la Corte de Cuentas de la República, como organismo superior de fiscalización de la gestión de la hacienda pública y de la ejecución del presupuesto del Estado.',
                'categoria_id' => $categoriaFiscalId,
                'vigente' => 1,
            ],
            [
                'titulo' => 'Ámbito de aplicación y entidades sujetas a control',
                'ley_referencia' => 'Ley de la Corte de Cuentas de la República',
                'articulo' => 'Artículo 2',
                'descripcion' => 'Están sujetas a la fiscalización y control de la Corte de Cuentas todas las entidades del Estado, los organismos oficiales autónomos, las municipalidades, y en general, toda persona natural o jurídica que reciba, custodie, administre o maneje fondos, bienes o recursos públicos.',
                'categoria_id' => $categoriaFiscalId,
                'vigente' => 1,
            ],
            [
                'titulo' => 'Atribuciones básicas de fiscalización',
                'ley_referencia' => 'Ley de la Corte de Cuentas de la República',
                'articulo' => 'Artículo 5',
                'descripcion' => 'Corresponde a la Corte de Cuentas fiscalizar la recaudación, custodia, inversión y liquidación de los caudales públicos; practicar auditorías financieras, operacionales y de gestión; examinar las cuentas de los funcionarios y empleados que administren recursos estatales y dictaminar sobre la ejecución presupuestaria.',
                'categoria_id' => $categoriaFiscalId,
                'vigente' => 1,
            ],
            [
                'titulo' => 'El Control Interno en las instituciones públicas',
                'ley_referencia' => 'Ley de la Corte de Cuentas de la República',
                'articulo' => 'Artículo 13',
                'descripcion' => 'Cada entidad sujeta a control es responsable de establecer, mantener y perfeccionar su propio sistema de control interno, el cual debe diseñarse para salvaguardar los recursos públicos, verificar la exactitud de la información financiera y promover la eficiencia operativa.',
                'categoria_id' => $categoriaFiscalId,
                'vigente' => 1,
            ],
            [
                'titulo' => 'El Control Externo a cargo de la Corte de Cuentas',
                'ley_referencia' => 'Ley de la Corte de Cuentas de la República',
                'articulo' => 'Artículo 17',
                'descripcion' => 'El control externo es la vigilancia y examen independiente que realiza la Corte de Cuentas sobre la gestión financiera y administrativa de las entidades sujetas a su control, con posterioridad a la ejecución de sus operaciones, mediante la práctica de auditorías gubernamentales.',
                'categoria_id' => $categoriaFiscalId,
                'vigente' => 1,
            ],
            [
                'titulo' => 'Definición y alcance de la Auditoría Gubernamental',
                'ley_referencia' => 'Ley de la Corte de Cuentas de la República',
                'articulo' => 'Artículo 23',
                'descripcion' => 'La auditoría gubernamental es el examen objetivo, sistemático, profesional e independiente de las operaciones financieras, administrativas y operativas de las entidades sujetas a control, realizado con el fin de verificarlas, evaluarlas y emitir el informe con los comentarios, conclusiones y recomendaciones.',
                'categoria_id' => $categoriaFiscalId,
                'vigente' => 1,
            ],
            [
                'titulo' => 'Obligación de colaborar con los auditores de la Corte',
                'ley_referencia' => 'Ley de la Corte de Cuentas de la República',
                'articulo' => 'Artículo 28',
                'descripcion' => 'Todos los funcionarios, empleados y contratistas de las entidades sujetas a control están obligados a suministrar a los auditores de la Corte de Cuentas, de manera oportuna y completa, todos los libros, registros, documentos, informes y aclaraciones que les sean requeridos para el desempeño de sus funciones.',
                'categoria_id' => $categoriaFiscalId,
                'vigente' => 1,
            ],
            [
                'titulo' => 'La Responsabilidad Administrativa de los funcionarios',
                'ley_referencia' => 'Ley de la Corte de Cuentas de la República',
                'articulo' => 'Artículo 41',
                'descripcion' => 'Incurren en responsabilidad administrativa los funcionarios y empleados públicos que infrinjan las normas legales o reglamentarias que rigen la gestión financiera y operativa del Estado, o que incumplan las instrucciones y recomendaciones dictadas por la Corte de Cuentas.',
                'categoria_id' => $categoriaFiscalId,
                'vigente' => 1,
            ],
            [
                'titulo' => 'La Responsabilidad Patrimonial por menoscabo económico',
                'ley_referencia' => 'Ley de la Corte de Cuentas de la República',
                'articulo' => 'Artículo 45',
                'descripcion' => 'La responsabilidad patrimonial nace cuando un funcionario o empleado público, por acción u omisión, con dolo, culpa o negligencia grave, cause un menoscabo, perjuicio económico o pérdida de los bienes y recursos del Estado o de la entidad en que labora, quedando obligado a la restitución del daño.',
                'categoria_id' => $categoriaFiscalId,
                'vigente' => 1,
            ],
            [
                'titulo' => 'Facultad sancionatoria e imposición de multas',
                'ley_referencia' => 'Ley de la Corte de Cuentas de la República',
                'articulo' => 'Artículo 51',
                'descripcion' => 'La Corte de Cuentas tiene la facultad de imponer multas a los funcionarios y empleados públicos por infracciones administrativas, retrasos en la rendición de cuentas, obstaculización de las auditorías o negligencia en la custodia de bienes públicos, de conformidad con las escalas establecidas en la ley.',
                'categoria_id' => $categoriaFiscalId,
                'vigente' => 1,
            ],
            [
                'titulo' => 'El Juicio de Cuentas ante las Cámaras de Primera Instancia',
                'ley_referencia' => 'Ley de la Corte de Cuentas de la República',
                'articulo' => 'Artículo 62',
                'descripcion' => 'Cuando un informe de auditoría contenga hallazgos con presunta responsabilidad administrativa o patrimonial, se iniciará el Juicio de Cuentas ante las Cámaras de Primera Instancia de la Corte. En este proceso se garantizará el debido proceso, el derecho de audiencia y la oportunidad del funcionario para desvanecer los reparos presentados.',
                'categoria_id' => $categoriaFiscalId,
                'vigente' => 1,
            ],
            [
                'titulo' => 'Recurso de Apelación ante la Cámara de Segunda Instancia',
                'ley_referencia' => 'Ley de la Corte de Cuentas de la República',
                'articulo' => 'Artículo 74',
                'descripcion' => 'Contra las sentencias definitivas pronunciadas por las Cámaras de Primera Instancia, procederá el Recurso de Apelación ante la Cámara de Segunda Instancia de la Corte de Cuentas. El recurso deberá interponerse por escrito dentro del término legal establecido, expresando los agravios que la resolución causa al apelante.',
                'categoria_id' => $categoriaFiscalId,
                'vigente' => 1,
            ],
            [
                'titulo' => 'Obligación de denunciar delitos detectados en auditorías',
                'ley_referencia' => 'Ley de la Corte de Cuentas de la República',
                'articulo' => 'Artículo 89',
                'descripcion' => 'Cuando en la práctica de una auditoría gubernamental se encuentren indicios de la comisión de hechos delictivos (como malversación de fondos, peculado o enriquecimiento ilícito), la Corte de Cuentas tiene la obligación legal de certificar de inmediato lo conducente y remitirlo a la Fiscalía General de la República para el inicio de la acción penal correspondientes.',
                'categoria_id' => $categoriaFiscalId,
                'vigente' => 1,
            ]
        ]);

        // =========================================================================
        // SECCIÓN 5: RÉGIMEN POLICIAL (LEY DISCIPLINARIA POLICIAL)
        // =========================================================================
        $categoriaPolicialId = DB::table('categoria_legal')->insertGetId([
            'nombre' => 'Derecho Policial y Régimen Disciplinario',
            'descripcion' => 'Normas de conducta, clasificación de faltas, derechos de los ciudadanos ante la PNC y procedimientos de denuncia.'
        ]);

        DB::table('regla_legal')->insert([
            [
                'titulo' => 'Objeto de la Ley Disciplinaria Policial',
                'ley_referencia' => 'Ley Disciplinaria Policial',
                'articulo' => 'Artículo 1',
                'descripcion' => 'La presente ley tiene por objeto establecer el régimen disciplinario aplicable a los miembros de la Policía Nacional Civil, a fin de asegurar el estricto cumplimiento de sus deberes constitucionales, legales y reglamentarios, garantizando el respeto a los derechos humanos y la eficiencia del servicio policial.',
                'categoria_id' => $categoriaPolicialId,
                'vigente' => 1,
            ],
            [
                'titulo' => 'Ámbito de aplicación del régimen policial',
                'ley_referencia' => 'Ley Disciplinaria Policial',
                'articulo' => 'Artículo 2',
                'descripcion' => 'Quedan sujetos a las disposiciones de esta ley todos los miembros de la Policía Nacional Civil, cualquiera que sea su categoría, escala, grado o cargo, que se encuentren en situación de servicio activo o en comisión de servicio.',
                'categoria_id' => $categoriaPolicialId,
                'vigente' => 1,
            ],
            [
                'titulo' => 'Derechos fundamentales del policía investigado',
                'ley_referencia' => 'Ley Disciplinaria Policial',
                'articulo' => 'Artículo 4',
                'descripcion' => 'En todo procedimiento disciplinario se garantizarán los derechos de audiencia, defensa, presunción de inocencia, legalidad, proporcionalidad de la sanción y el debido proceso. El miembro de la Policía investigado tendrá derecho a ser notificado formalmente y a proponer pruebas.',
                'categoria_id' => $categoriaPolicialId,
                'vigente' => 1,
            ],
            [
                'titulo' => 'Definición y ejemplos de Faltas Leves',
                'ley_referencia' => 'Ley Disciplinaria Policial',
                'articulo' => 'Artículo 8',
                'descripcion' => 'Constituyen faltas leves las acciones u omisiones que impliquen descuidos menores en el servicio, tales como: el descuido en el aseo personal o el uso incorrecto del uniforme; la impuntualidad injustificada a las labores; y la falta de respeto leve a compañeros de trabajo o ciudadanos siempre que no constituya maltrato grave.',
                'categoria_id' => $categoriaPolicialId,
                'vigente' => 1,
            ],
            [
                'titulo' => 'Definición y catálogo de Faltas Graves',
                'ley_referencia' => 'Ley Disciplinaria Policial',
                'articulo' => 'Artículo 9',
                'descripcion' => 'Constituyen faltas graves los actos que afecten la operatividad o el decoro de la institución, entre ellos: proferir expresiones ofensivas o ejecutar maltrato físico o verbal contra los ciudadanos; desobedecer órdenes legítimas de los superiores; abandonar el servicio asignado sin causa justificada; y consumir bebidas embriagantes o sustancias prohibidas durante la jornada laboral.',
                'categoria_id' => $categoriaPolicialId,
                'vigente' => 1,
            ],
            [
                'titulo' => 'Definición y catálogo de Faltas Muy Graves',
                'ley_referencia' => 'Ley Disciplinaria Policial',
                'articulo' => 'Artículo 10',
                'descripcion' => 'Constituyen faltas muy graves las conductas de máxima gravedad que atentan contra la ley y los derechos humanos, tales como: cometer actos que constituyan delitos dolosos; ejercer tortura, tratos crueles, inhumanos o degradantes a personas detenidas; solicitar o recibir dádivas, sobornos o recompensas (corrupción); usar el armamento estatal de forma arbitraria o desproporcionada; y participar en actividades políticas partidarias.',
                'categoria_id' => $categoriaPolicialId,
                'vigente' => 1,
            ],
            [
                'titulo' => 'Sanciones aplicables para Faltas Leves',
                'ley_referencia' => 'Ley Disciplinaria Policial',
                'articulo' => 'Artículo 12',
                'descripcion' => 'Las faltas leves serán sancionadas, según su gravedad, con reprensión verbal, reprensión escrita o con suspensión del servicio sin goce de sueldo desde uno hasta un máximo de cinco días.',
                'categoria_id' => $categoriaPolicialId,
                'vigente' => 1,
            ],
            [
                'titulo' => 'Sanciones aplicables para Faltas Graves',
                'ley_referencia' => 'Ley Disciplinaria Policial',
                'articulo' => 'Artículo 13',
                'descripcion' => 'Las faltas graves se sancionarán con la suspensión del servicio sin goce de sueldo desde seis hasta noventa días. Esta sanción conlleva la pérdida del derecho a ascenso durante el tiempo que fije el reglamento.',
                'categoria_id' => $categoriaPolicialId,
                'vigente' => 1,
            ],
            [
                'titulo' => 'Sanciones aplicables para Faltas Muy Graves',
                'ley_referencia' => 'Ley Disciplinaria Policial',
                'articulo' => 'Artículo 14',
                'descripcion' => 'Las faltas muy graves serán sancionadas exclusivamente con la destitución del cargo y la destitución definitiva de la Policía Nacional Civil, inhabilitando al sancionado para reingresar a la institución.',
                'categoria_id' => $categoriaPolicialId,
                'vigente' => 1,
            ],
            [
                'titulo' => 'Derecho ciudadano a denunciar abusos policiales',
                'ley_referencia' => 'Ley Disciplinaria Policial',
                'articulo' => 'Artículo 32',
                'descripcion' => 'Cualquier ciudadano que se considere afectado por el mal actuar, abuso de autoridad o agresión de un miembro de la Policía Nacional Civil, tiene el derecho pleno de interponer una denuncia formal ante la Inspectoría General de Seguridad Pública o en las delegaciones policiales ante la sección de investigación disciplinaria.',
                'categoria_id' => $categoriaPolicialId,
                'vigente' => 1,
            ],
            [
                'titulo' => 'Obligación de remitir indicios delictivos a la FGR',
                'ley_referencia' => 'Ley Disciplinaria Policial',
                'articulo' => 'Artículo 45',
                'descripcion' => 'Si durante la investigación de un proceso disciplinario interno se determina que la falta cometida por el agente policial constituye también un delito penal (como extorsión, agresiones o cohecho), el tribunal disciplinario tendrá la obligación inmediata de remitir certificación de todo lo actuado a la Fiscalía General de la República.',
                'categoria_id' => $categoriaPolicialId,
                'vigente' => 1,
            ],
            [
                'titulo' => 'El Recurso de Apelación ante resoluciones disciplinarias',
                'ley_referencia' => 'Ley Disciplinaria Policial',
                'articulo' => 'Artículo 58',
                'descripcion' => 'Contra las resoluciones sancionatorias emitidas por los Tribunales Disciplinarios de la Policía, procederá el Recurso de Apelación ante el Tribunal Disciplinario Nacional. El recurso deberá interponerse por escrito en el plazo perentorio de cinco días hábiles contados a partir del día siguiente de la notificación oficial.',
                'categoria_id' => $categoriaPolicialId,
                'vigente' => 1,
            ]
        ]);

        // =========================================================================
        // SECCIÓN 6: TRÁNSITO Y SEGURIDAD VIAL (REGLAMENTO DE TRÁNSITO)
        // =========================================================================
        $categoriaTransitoId = DB::table('categoria_legal')->insertGetId([
            'nombre' => 'Derecho de Tránsito y Seguridad Vial',
            'descripcion' => 'Normas de circulación vial, prioridades de paso, responsabilidades en accidentes de tránsito y regulaciones para conductores.'
        ]);

        DB::table('regla_legal')->insert([
            [
                'titulo' => 'Objeto y finalidad del Reglamento de Tránsito',
                'ley_referencia' => 'Reglamento General de Tránsito y Seguridad Vial',
                'articulo' => 'Artículo 1',
                'descripcion' => 'El presente Reglamento tiene por objeto desarrollar lo establecido en la Ley de Transporte Terrestre, Tránsito y Seguridad Vial, normando el tránsito vehicular y peatonal para garantizar la seguridad de las personas, el orden público y la fluidez en las vías públicas de El Salvador.',
                'categoria_id' => $categoriaTransitoId,
                'vigente' => 1,
            ],
            [
                'titulo' => 'Obligatoriedad de portar la Licencia de Conducir',
                'ley_referencia' => 'Reglamento General de Tránsito y Seguridad Vial',
                'articulo' => 'Artículo 33',
                'descripcion' => 'Todo conductor de un vehículo automotor está obligado a portar su licencia de conducir vigente y el documento único de identidad, los cuales deberán estar autorizados para la clase o tipo de vehículo que se conduce, debiendo mostrarlos a la autoridad competente cuando le sean requeridos.',
                'categoria_id' => $categoriaTransitoId,
                'vigente' => 1,
            ],
            [
                'titulo' => 'Obligación de portar la Tarjeta de Circulación',
                'ley_referencia' => 'Reglamento General de Tránsito y Seguridad Vial',
                'articulo' => 'Artículo 45',
                'descripcion' => 'Todo vehículo que circule por las vías públicas del país debe portar su respectiva Tarjeta de Circulación vigente, la cual acredita que el vehículo se encuentra debidamente inscrito en el Registro Público de Vehículos y apto para la circulación.',
                'categoria_id' => $categoriaTransitoId,
                'vigente' => 1,
            ],
            [
                'titulo' => 'Reglas generales de velocidad en zonas urbanas y rurales',
                'ley_referencia' => 'Reglamento General de Tránsito y Seguridad Vial',
                'articulo' => 'Artículo 145',
                'descripcion' => 'Los conductores deberán guiar sus vehículos a una velocidad moderada y prudente, respetando los límites máximos señalizados. En zonas urbanas comerciales o residenciales, la velocidad máxima será de cuarenta kilómetros por hora, reduciéndose a veinte kilómetros por hora en zonas escolares o de hospitales.',
                'categoria_id' => $categoriaTransitoId,
                'vigente' => 1,
            ],
            [
                'titulo' => 'Prioridad de paso en intersecciones y rotondas',
                'ley_referencia' => 'Reglamento General de Tránsito y Seguridad Vial',
                'articulo' => 'Artículo 152',
                'descripcion' => 'En las intersecciones donde no existan semáforos ni señales de prioridad, el conductor tiene la obligación de ceder el paso a los vehículos que se aproximen por su derecha. Asimismo, el vehículo que ya circula dentro de una rotonda o redondel tiene prioridad absoluta de paso sobre los que pretenden ingresar a ella.',
                'categoria_id' => $categoriaTransitoId,
                'vigente' => 1,
            ],
            [
                'titulo' => 'Uso obligatorio del cinturón de seguridad',
                'ley_referencia' => 'Reglamento General de Tránsito y Seguridad Vial',
                'articulo' => 'Artículo 168',
                'descripcion' => 'Es obligatorio para el conductor y el acompañante en el asiento delantero el uso del cinturón de seguridad en todo vehículo automotor en marcha. El incumplimiento de esta disposición constituye una infracción de tránsito sujeta a sanción económica.',
                'categoria_id' => $categoriaTransitoId,
                'vigente' => 1,
            ],
            [
                'titulo' => 'Prohibiciones estrictas al conducir un vehículo',
                'ley_referencia' => 'Reglamento General de Tránsito y Seguridad Vial',
                'articulo' => 'Artículo 172',
                'descripcion' => 'Se prohíbe terminantemente a los conductores: guiar vehículos bajo los efectos del alcohol, drogas o estupefacientes; hacer uso de teléfonos celulares o dispositivos de comunicación mientras el vehículo esté en movimiento sin sistema de manos libres; y disputar la vía o realizar maniobras temerarias que pongan en peligro a terceros.',
                'categoria_id' => $categoriaTransitoId,
                'vigente' => 1,
            ],
            [
                'titulo' => 'Procedimiento obligatorio en caso de Accidente de Tránsito',
                'ley_referencia' => 'Reglamento General de Tránsito y Seguridad Vial',
                'articulo' => 'Artículo 185',
                'descripcion' => 'En caso de ocurrir un accidente de tránsito en el que se produzcan daños materiales o personales, los conductores implicados tienen la obligación de detener inmediatamente la marcha, encender las luces de advertencia, auxiliar a los heridos si los hubiere y dar aviso inmediato a la Policía Nacional Civil, absteniéndose de mover los vehículos hasta que la autoridad levante el croquis respectivo.',
                'categoria_id' => $categoriaTransitoId,
                'vigente' => 1,
            ],
            [
                'titulo' => 'Mover vehículos en colisiones menores con daños materiales',
                'ley_referencia' => 'Reglamento General de Tránsito y Seguridad Vial',
                'articulo' => 'Artículo 187',
                'descripcion' => 'Cuando en un accidente de tránsito se produzcan exclusivamente daños materiales menores y los vehículos obstruyan gravemente la circulación, los conductores podrán mover los vehículos a la orilla de la vía pública para despejar el tráfico, siempre que exista un acuerdo mutuo inmediato entre las partes o se hayan tomado fotografías legibles de la posición original de la colisión.',
                'categoria_id' => $categoriaFiscalId ?? $categoriaTransitoId, // Asegura que herede de tránsito en cualquier caso
                'categoria_id' => $categoriaTransitoId,
                'vigente' => 1,
            ],
            [
                'titulo' => 'Regulaciones sobre el estacionamiento en vías públicas',
                'ley_referencia' => 'Reglamento General de Tránsito y Seguridad Vial',
                'articulo' => 'Artículo 199',
                'descripcion' => 'Se prohíbe estacionar vehículos en los lugares siguientes: sobre las aceras, pasos peatonales o ciclovías; frente a entradas de garajes residenciales o comerciales; a menos de cinco metros de una intersección o de un hidrante de incendios; y en ejes preferenciales o zonas señalizadas con franja amarilla continua.',
                'categoria_id' => $categoriaTransitoId,
                'vigente' => 1,
            ],
            [
                'titulo' => 'Sanciones e Infracciones de Tránsito',
                'ley_referencia' => 'Reglamento General de Tránsito y Seguridad Vial',
                'articulo' => 'Artículo 250',
                'descripcion' => 'Las infracciones a las disposiciones de este reglamento serán sancionadas de orden gubernativo por el Viceministerio de Transporte (VMT) mediante la imposición de multas, retención de la licencia de conducir o decomiso del vehículo automotor, clasificándose en leves, graves y muy graves según la naturaleza del riesgo causado.',
                'categoria_id' => $categoriaTransitoId,
                'vigente' => 1,
            ]
        ]);


        // =========================================================================
        // SECCIÓN 7: TARIFAS DE TRANSPORTE PÚBLICO (ZONA ORIENTAL)
        // =========================================================================
        $categoriaTarifasId = DB::table('categoria_legal')->insertGetId([
            'nombre' => 'Tarifas de Transporte Público (Zona Oriental)',
            'descripcion' => 'Listado oficial de tarifas y pasajes autorizados por el VMT para rutas de autobuses y microbuses en Oriente.'
        ]);

        DB::table('regla_legal')->insert([
            [
                'titulo' => 'Límites de tarifas y cobros del transporte colectivo',
                'ley_referencia' => 'Acuerdo de Tarifas Oficiales del Viceministerio de Transporte (VMT)',
                'articulo' => 'Regulación General',
                'descripcion' => 'Todo concesionario de transporte público colectivo (autobuses y microbuses) está obligado a respetar estrictamente la tarifa legalmente autorizada por el VMT. El cobro excesivo o arbitrario constituye una infracción grave que puede ser denunciada por los usuarios para la aplicación de sanciones económicas o suspensión de la concesión.',
                'categoria_id' => $categoriaTarifasId,
                'vigente' => 1,
            ],
            [
                'titulo' => 'Tarifas oficiales VMT - Departamento de La Unión',
                'ley_referencia' => 'Listado de Tarifas VMT',
                'articulo' => 'Sector La Unión',
                'descripcion' => 'Pasajes autorizados para autobuses (AB) y microbuses (MB) en el corredor de La Unión: Ruta AB331 (Rutas AB331, AB331-C, AB331-D) tiene una tarifa fija autorizada de $0.97; Ruta AB331-B se establece en $1.12; Ruta AB712 tiene un costo oficial de $0.25; Ruta AB324 de La Unión se detalla en $0.90 y su variante AB324-X en $1.25; Ruta AB304 varía según servicio siendo $3.19 el ordinario y $5.55 el especial; Ruta AB306 ordinario $3.19; Ruta AB54 tiene un costo local de $0.20; Ruta AB760 autoriza $0.35; y la ruta de microbús local MB001-UN tiene un pasaje base de $0.25.',
                'categoria_id' => $categoriaTarifasId,
                'vigente' => 1,
            ],
            [
                'titulo' => 'Tarifas oficiales VMT - Departamento de San Miguel',
                'ley_referencia' => 'Listado de Tarifas VMT',
                'articulo' => 'Sector San Miguel',
                'descripcion' => 'Pasajes autorizados para rutas que operan en San Miguel: Ruta AB301 ordinaria tiene un costo de $2.24; Ruta AB308 tiene una tarifa de $2.17; Ruta AB316 ordinaria se establece en $1.17 y su servicio AB316-A1 en $3.50; Ruta AB318-A autoriza $1.91 y la AB318 regular $1.52; Ruta AB319 fija su pasaje en $0.80; Ruta AB320-B en $1.04; Ruta AB325-A en $0.74; Rutas locales interurbanas como la AB88, AB91, AB94 y AB95 tienen un costo base de $0.20; Ruta AB90-G cuesta $0.25 y la AB90 ordinaria $0.34; Ruta AB714-X autoriza $1.00; Ruta AB754 cuesta $0.31; y los microbuses locales MB001-SM y MB002-SM registran un cobro urbano de $0.40 y $0.25 respectivamente.',
                'categoria_id' => $categoriaTarifasId,
                'vigente' => 1,
            ],
            [
                'titulo' => 'Tarifas oficiales VMT - Departamento de Morazán',
                'ley_referencia' => 'Listado de Tarifas VMT',
                'articulo' => 'Sector Morazán',
                'descripcion' => 'Pasajes autorizados para el sector de Morazán: Ruta AB328 regular tiene una tarifa de $1.67 y su variante AB328-A se establece en $0.90; Ruta AB327 cuesta $1.67; Ruta AB332-B se fija en $1.91 y las variantes AB332-A, C, D y E en $1.77; Ruta AB337 cuesta $1.08; Ruta AB386 tiene un pasaje de $1.77; Ruta AB410 tiene un costo unificado de $0.90; Ruta AB726 y AB727 cobran un pasaje de $0.61; Ruta AB729 cuesta $1.08; Ruta AB730 se fija en $1.30; Ruta AB733 cobra $0.29; Ruta AB743 cuesta $1.35; y el microbús MB001-MO registra una tarifa base de $0.25.',
                'categoria_id' => $categoriaTarifasId,
                'vigente' => 1,
            ],
            [
                'titulo' => 'Tarifas oficiales VMT - Departamento de Usulután',
                'ley_referencia' => 'Listado de Tarifas VMT',
                'articulo' => 'Sector Usulután',
                'descripcion' => 'Pasajes autorizados para el sector de Usulután: Ruta AB302 regular cuesta $1.54 y su variante especial AB302-1 se eleva a $3.00; Ruta AB303 ordinaria cuesta $2.24; Ruta AB309 cuesta $1.91; Ruta AB311 y AB312 registran un costo de $1.67; Ruta AB314 cuesta $1.54; Ruta AB322 autoriza $1.08; Ruta AB323 cuesta $0.88; Ruta AB340 cuesta $1.04; Ruta AB348 se fija en $1.12; Ruta AB354 regular cuesta $0.44; Ruta AB363 cobra $0.48; Ruta AB366 se fija en $0.38; Ruta AB370 autoriza $0.88; Ruta AB373 cuesta $0.90; Ruta AB776 cobra $0.29; Ruta AB787 cuesta $0.20; y el microbús MB001-US cobra $0.25.',
                'categoria_id' => $categoriaTarifasId,
                'vigente' => 1,
            ]
        ]);
    }
}