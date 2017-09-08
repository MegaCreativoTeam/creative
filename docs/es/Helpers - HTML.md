## Tooltips
===========
```php
Helper::get('html')->tooltip( $title, $placement );
```

| **Nombre**    | **Tipo**  | **Por defecto**   | **Descripción**   |
|---------------|:---------:|:------------------|:------------------|
| title         | string    | ""                | Valor por defecto del titulo que se mostrará        |
| placement     | string    | "*top*"             | Establece la posición del Tooltip: ```top | bottom | left | right | auto```. Cuando se especifica "auto", se reorientará dinámicamente la información de herramientas. Por ejemplo, si la colocación es "auto left", la información de herramientas se mostrará a la izquierda cuando sea posible, de lo contrario se mostrará a la derecha.       |


## Icon Required

```php
Helper::get('html')->icon_required( $replacement );
```

| **Nombre**    | **Tipo**  | **Por defecto**   | **Descripción**   |
|---------------|:---------:|:------------------|:------------------|
| replacement   | string    | ""                | Valor por defecto del titulo que se mostrará.        |


## Icon Help

```php
Helper::get('html')->icon_help( $text );
```

| **Nombre**    | **Tipo**  | **Por defecto**   | **Descripción**   |
|---------------|:---------:|:------------------|:------------------|
| text          | string    | ""                | Valor por defecto del text que se mostrará.        |


## Icon Info

```php
Helper::get('html')->icon_info( $text );
```

| **Nombre**    | **Tipo**  | **Por defecto**   | **Descripción**   |
|---------------|:---------:|:------------------|:------------------|
| text          | string    | ""                | Valor por defecto del text que se mostrará.        |