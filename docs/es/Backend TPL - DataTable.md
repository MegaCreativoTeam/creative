# Atributos del Template DataTable usado en Backend

```php
array(

    'columns' => array(

        //
        'dni' => array(            
            
            /**
             * Texto o Label que aparecerá en la cabecera de la table
             */
            'text' => 'Nombre',

            /** 
             * Establece a la columna como una Clave Primaria, 
             * esta propiedad convierte al texto en un Hipervinculo 
             * que al hacer click en el despliega los detalles del registro
             */
            'primary' => TRUE,

            /**
             * Tipo de dato
             */
            'type' => 'number',
            
            /**
             * Formato en el que se representará el campo
             */
            'format' => array(
                0,      //int Decimales                
                ',',    //string Separador de deciamles                
                '.',    //string Separador de Miles
            )
        )

        'name' => array(
            'text' => 'Nombre',
        ),

        'status' => array(
            'text' => 'Estatus',
            'align' => 'center',
            'type' => 'label',					
            'labelclass' => 'status_class',
            'tooltips' => 'status_info'
        ),
        
        'date_init' => array(
            'text' => 'Fecha de inicio',
        ),

    )
)
```

| **DNI**           | **Nombre**    | **Estatus**   | **Fecha de inicio**   |
|-------------------|:--------------|:-------------:|----------------------:|
| *20.568.744*      | Jhon Doe      | **Active**    | 02/06/2017            |
| *37.455.456*      | Maria Suse    | **Inactive**  | 06/12/2016            |
| *27.075.412*      | Ana Lou       | **Active**    | 25/12/2015            |
| **DNI**           | **Nombre**    | **Estatus**   | **Fecha de inicio**   |

## Text
Texto o Label que aparecerá en la cabecera del DataTable

## Type
Esta propiedad permite establecer el tipo de dato en el que se presenta los campos de esta columna, los posibles valores son: [ *date* | *number* | *label* ]

El tipo de campo *label* a su vez tiene otras tres (3) propiedades: *labelclass*, *tooltips*

## Primary
Esta propiedad establece a la columna como una *Clave Primaria*, convierte al texto de la columna en un Hipervinculo que al hacer click en el, despliega los detalles del registro en un Modal.

## Align
Esta propiedad determina la alineación de la columna, sus posibles valores son: [ *left* | *center* | *right* ]

## Format
Esta propiedad permite aplicarle un formato a una columna.

### Format Date
Estos formatos de fecha y hora estan dentro del formato determinado **strftime()**.

```php
'format' => "%D"
Output: 02/06/01

'format' => "%I:%M %p"
Output: 02:33 pm

'format' => "%A, %B %e, %Y"
Output: Monday, February 5, 2001

'format' => "%H:%M:%S"
Output: 14:33:00
```

> * **_%a_** - nombre del día de la semana abreviado de acuerdo al local actual
> * **_%A_** - nombre del día de la semana anterior de acuerdo al local actual
> * **_%b_** - nombre del mes abreviado de acuerdo al local actual
> * **_%B_** - nombre del mes anterior de acuerdo al local actual
> * **_%c_** - Representación preferencial de la fecha y hora local actual
> * **_%C_** - año con dos dígitos (o año dividido por 100 y truncadopara un entero, intervalo de 00 a 99)
> * **_%d_** - día del mes como un número decimal (intervalo de 00 a 31)
> * **_%D_** - Lo mismo que %m/%d/%y
> * **_%e_** - Día del mes como un número decimal, un único dígito y precedido por un espacio (intervalo de 1 a 31)
> * **_%g_** - Año basado en la semana, sin el siglo [00,99]
> * **_%G_** - Año basado en la semana, incluyendo el siglo [0000,9999]
> * **_%h_** - Lo mismo que %b
> * **_%H_** - Hora como un número decimal usando un relój de 24 horas (intervalo de 00 a 23)
> * **_%I_** - Hora como un número decimal usando un relój de 12 horas (intervalo de 01 a 12)
> * **_%j_** - Día del año como um número decimal (intervalo de 001 a 366)
> * **_%k_** - Hora (relój de 24 horas) digítos únicos que son precedidos por un espacio en blanco (intervalo de 0 a 23)
> * **_%l_** - Hora como un número decimal usando un relój de 12 horas, digítos únicos son precedidos por un espacio en blanco (intervalo de 1 a 12)
> * **_%m_** - Mes como número decimal (intervalo de 01 a 12)
> * **_%M_** - Minuto como un número decimal
> * **_%n_** - Caracter de nueva linea
> * **_%p_** - Cualquiera 'am' o 'pm' de acuerdo con el valor de la hora dado, o la cadena correspondiente a la local actual
> * **_%* r_** - Hora con notación a.m. y p.m.
> * **_%R_** - Hora con notación de 24 horas
> * **_%S_** - Segundo como número decimal
> * **_%t_** - Caracter tab
> * **_%T_** - Hora actual, igual a %H:%M:%S
> * **_%u_** - Día de la semana como un número decimal [1,7], representando con 1 el lunes
> * **_%U_** - Número de la semana del año actual como un número decimal, comenzando con el primer domingo como primer dia de la primera semana
> * **_%V_** - Número de la semana del año actual como número decimal de acuerdo con el ISO 8601:1988, intervalo de 01 a 53, en donde 1 es la primera semana que tenga por lo menos cuatro dias en el año actual, siendo domingo el primer dia de la semana.
> * **_%w_** - Día de la semana como decimal, siendo domingo 0
> * **_%W_** - Número de la semana del año actual como número decimal, comenzando con el primer lunes como primer dia de la primera semana
> * **_%x_** - Representación preferida para la fecha local actual sin la hora
> * **_%X_** - Representación preferida de la hora local actual sin la fecha
> * **_%y_** - Año como número decimal sin el siglo(intervalo de 00 a 99)
> * **_%Y_** - Año como número decimal incluyendo el siglo
> * **_%Z_** - Zona horaria, o nombre, o abreviación
> * **_%%_** - Un carácter '%'


### Format Number

Esta es una manera de formatear cadenas, como números decimales y otros.

```php
array(
    //int Decimales
    2,

    //string Separador de deciamles
    ',',

    //string Separador de Miles
    '.'
)
```