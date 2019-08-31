<?php

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * This type has been specifically created for upload based modules, it works with directories tree array
 * just like it is done with recursive folders menu also for uploadType
 *
 * This name of class MUST be written like this (at least in Symfony 4.2) otherwise symfony won't load twig template for this type
 *
 * Class DatalistType
 * @package App\Form\Type
 */
class UploadrecursiveoptionsType extends AbstractType {

    /**
     * This is dirty workaround, couldn't find any proper way to pass var to form as custom attribute
     * This will check if the form which should have main folder on selection list is the array
     * The names are strange - generated somehow by Symfony
     */
    const FORMS_NAMES_WITH_VISIBLE_MAIN_FOLDERS = [
        'upload_subdirectory_move_data',
        'upload_subdirectory_create',
        'upload_form',
        'move_single_file',
    ];

    public function getParent() {
        return ChoiceType::class;
    }

    public function buildView(FormView $view, FormInterface $form, array $options) {

        $form_name                     = $form->getParent()->getName();
        $view->vars['add_main_folder'] = false;

        if( in_array($form_name, static::FORMS_NAMES_WITH_VISIBLE_MAIN_FOLDERS) ){
            $view->vars['add_main_folder'] = true;
        }

    }

}