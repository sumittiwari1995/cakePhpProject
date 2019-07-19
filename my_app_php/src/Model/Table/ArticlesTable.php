
<?php
// in src/Model/Table/ArticlesTable.php
//namespace App\Model\Table;

// add this use statement right below the namespace declaration to import
// the Validator class
use Cake\Validation\Validator;

// Add the following method.
 function validationDefault(Validator $validator)
{
    $validator
        ->allowEmptyString('title', false)
        ->minLength('title', 10)
        ->maxLength('title', 255)

        ->allowEmptyString('body', false)
        ->minLength('body', 10);

    return $validator;
}

use Cake\ORM\Table;
// the Text class
use Cake\Utility\Text;

// Add the following method.

 function beforeSave($event, $entity, $options)
{
    if ($entity->isNew() && !$entity->slug) {
        $sluggedTitle = Text::slug($entity->title);
        // trim slug to maximum length defined in schema
        $entity->slug = substr($sluggedTitle, 0, 191);
    }
}