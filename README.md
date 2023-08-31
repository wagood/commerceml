PHP CommerceML 2
==============

### Оригинал
Форк библиотеки [commerceml](https://github.com/karakum/commerceml). Обновлено для работы с PHP v.8+, Symfony Event Dispatcher v.6+

### О библиотеке
Данная библиотека предназначена для поточного разбора выгруженных из 1с файлов по стандарту Commerce ML 2.

Сам парсер представляет собой диспетчер событий, т.е. при нахождении в структуре Commerce ML 2 объекта нужной структуры, диспетчером вызывается определенной событие и в него передается уже сформированные по модельной структуре объект.

На данный момент существует 7 основных событий:

* получение Владельца;
* получение Категории;
* получение Предложения;
* получение Категории Цен;
* получение Склада;
* получение Товара;
* получение Свойства товара.

### Простое использование парсера:

```php
// Создание экземпляра класса парсера
$parser = \CommerceMLParser\Parser::getInstance(); 

// добавление функции обработки события CategoryEvent
$parser->addListener("CategoryEvent", function (\CommerceMLParser\Event\CategoryEvent $event) {
    $categories = $event->getFlatCategories(); // get collection of Category's
}); 

// добавление функции обработки события ProductEvent
$parser->addListener("ProductEvent", function (\CommerceMLParser\Event\ProductEvent $event)
    $product = $event->getProduct(); // get one Product Model
}); 

$parser->parse($pathToImportXmlFile); // полный путь до файла import.xml (Commerce ML 2) выгрузки из 1с
$parser->parse($pathToOfferXmlFile); // полный путь до файла offer.xml (Commerce ML 2) выгрузки из 1с
```
