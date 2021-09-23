<?php

namespace App\Form;

use App\Entity\Ad;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class AdType extends AbstractType
{
    /**
     * Undocumented function
     *
     * @param [type] $label
     * @param [type] $placeholder
     * @return array
     */
    private function getConfiguration($label,$placeholder) {
        return[
            'label' => $label,
            'attr' => [
                'placeholder' =>$placeholder
            ]
            ];
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title',TextType::class, $this->getConfiguration("Titre","Titre de votre annonce"))
            ->add('slug', TextType::class, $this->getConfiguration("Adresse web ","Tapez l'adreese web (automatique)"))
            ->add('price',MoneyType::class, $this->getConfiguration("Prix par nuit","Indiquez le prix que vous voulez pour une nuit "))
            ->add('introduction',TextType::class,$this->getConfiguration("Introduction","description globale de l'annonce"))
            ->add('content', TextareaType::class ,$this->getConfiguration("Description ","description "))
            ->add('coverImage',UrlType::class,$this->getConfiguration("Url d'image ","url "))
            ->add('rooms',IntegerType::class,$this->getConfiguration("Nombre de chambres","nombre de chambre disponible "))
            ->add('save',SubmitType::class,[
                'label'=>'creer la nouvelle annonce',
                'attr'=>[
                    'class'=>'btn btn-primary'
                ]
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ad::class,
        ]);
    }
}
