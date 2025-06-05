<?php

namespace Fv\FantasyVerse\Form;

use Fv\FantasyVerse\Entity\Conjuro;
use Fv\FantasyVerse\Entity\Personaje;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonajeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre')
            ->add('jugador')
            ->add('trasfondo')
            ->add('experiencia')
            ->add('raza')
            ->add('clases_niveles')
            ->add('clases_lanzadoras_conjuros')
            ->add('alineamiento')
            ->add('idiomas')
            ->add('inspiracion')
            ->add('velocidad')
            ->add('resistencias')
            ->add('vulnerabilidades')
            ->add('inmunidades')
            ->add('dado_golpe_tipo')
            ->add('xp_proximo_nivel')
            ->add('estado_actual')
            ->add('competencias_herramientas')
            ->add('notas')
            ->add('atributos')
            ->add('tiradas_salvacion')
            ->add('habilidades')
            ->add('ca')
            ->add('puntos_golpe')
            ->add('puntos_golpe_temporales')
            ->add('iniciativa')
            ->add('dados_golpe')
            ->add('magia')
            ->add('cd_conjuro')
            ->add('ataque_conjuro')
            ->add('conjuros_extra')
            ->add('carga_maxima')
            ->add('monedas')
            ->add('armas')
            ->add('equipo')
            ->add('rasgos_personalidad')
            ->add('ideales')
            ->add('vinculos')
            ->add('defectos')
            ->add('conjuros', EntityType::class, [
                'class' => Conjuro::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Personaje::class,
        ]);
    }
}
