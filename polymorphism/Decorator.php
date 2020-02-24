<?php

/**
 * В задании описан интерфейс Tag. Каждый класс, реализующий этот интерфейс, представляет из себя тег HTML.
 * Метод render(), позволяет получить текстовое представление тега:

<?php

$tag = new InputTag('submit', 'Save');
$tag->render(); // <input type="submit" value="Save">
 * Предположим, что эта система нужна для генерации разных кусков верстки, которая может быть очень
 * разнообразной. Попробуйте ответить на вопрос, сколько понадобится классов для представления всех
 * возможных комбинаций тегов?

 * Если создавать по классу на каждый возможный вариант верстки, то классов будет бесконечно много и
 * смысла в такой реализации очень мало. Но вместо этого лучше использовать композицию. Создать класс для
 * каждого индивидуального тега (в html5 их около 100 штук), а затем путем комбинирования получить все
 * возможные варианты верстки.

src/LabelTag.php
 * Реализуйте класс LabelTag, который реализует интерфейс Tag и умеет оборачивать другие теги:

<?php

$inputTag = new InputTag('submit', 'Save');
$labelTag = new LabelTag('Press Submit', $inputTag);
$labelTag->render();
// <label>
//   Press Submit
//   <input type="submit" value="Save">
// </label>
 * Подсказки
 * Паттерн Декоратор
 */

// src/Tag.php

namespace App\tags;

interface Tag
{
    public function render();
    public function __toString();
}

// src/InputTag.php

namespace App\tags;

class InputTag implements Tag
{
    private $type;
    private $value;

    public function __construct(string $type, $value)
    {
        $this->type = $type;
        $this->value = $value;
    }

    public function render()
    {
        return "<input type=\"{$this->type}\" value=\"{$this->value}\">";
    }

    public function __toString()
    {
        return $this->render();
    }
}

// src/LabelTag.php


namespace App\tags;

// BEGIN (write your solution here)
class LabelTag implements Tag
{
    private $text;
    private $classTag;

    public function __construct($text, Tag $classTag)
    {
        $this->text = $text;
        $this->classTag = $classTag;
    }

    public function render()
    {
        return "<label>{$this->text}{$this->classTag->render()}</label>";
    }

    public function __toString()
    {
        return $this->render();
    }
}
// END
