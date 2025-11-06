<?php

namespace App\Form\Admin;

use App\Entity\ChargementProduit;
use App\Entity\Produit;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChargementProduitEmbeddedType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('produit', EntityType::class, [
              'class' => Produit::class, 
          ])
          ->add('quantite', IntegerType::class, options: [
                'attr'=>['min'=>1],
                'empty_data' => 1,
                'invalid_message' => "Veuillez renseigner une quantité."
            ]);
    }
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(['data_class' => ChargementProduit::class]);
    }
}
