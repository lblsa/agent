<?php
namespace Acme\SpyBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;

use Knp\Menu\ItemInterface as MenuItemInterface;

class MissionAdmin extends Admin
{
    /**
     * Конфигурация отображения записи
     *
     * @param \Sonata\AdminBundle\Show\ShowMapper $showMapper
     * @return void
     */
    protected function configureShowField(ShowMapper $showMapper)
    {
        $showMapper
                ->add('id', null, array('label' => 'Идентификатор'))
                ->add('runtime', null, array('label' => 'Время выполнения'))
                ->add('needBuy', null, array('label' => 'Необходимость покупки'))
                ->add('costs', null, array('label' => 'Стоимость задания в баллах'))
                ->add('icons', null, array('label' => 'Блок иконок с необходимыми условиями выполнения'))
                ->add('description', null, array('label' => 'Текст с коротким описанием задания'));
    }

    /**
     * Конфигурация формы редактирования записи
     * @param \Sonata\AdminBundle\Form\FormMapper $formMapper
     * @return void
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
                ->add('runtime', null, array('label' => 'Время выполнения'))
                ->add('needBuy', null, array('label' => 'Необходимость покупки'))
                ->add('costs', null, array('label' => 'Стоимость задания в баллах'))
                ->add('icons', null, array('label' => 'Блок иконок с необходимыми условиями выполнения'))
                ->add('description', null, array('label' => 'Текст с коротким описанием задания'))
                ->setHelps(array(
                                'runtime' => 'Время выполнения',
                                'needBuy' => 'Необходимость покупки',
                                'costs' => 'Стоимость задания в баллах',
                                'icons' => 'Блок иконок с необходимыми условиями выполнения',
                                'description' => 'Текст с коротким описанием задания'
                           ));

    }

    /**
     * Конфигурация списка записей
     *
     * @param \Sonata\AdminBundle\Datagrid\ListMapper $listMapper
     * @return void
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
                ->addIdentifier('id')
                ->addIdentifier('runtime', null, array('label' => 'Время выполнения'))
                ->addIdentifier('needBuy', null, array('label' => 'Необходимость покупки'))
                ->addIdentifier('costs', null, array('label' => 'Стоимость задания в баллах'))
                ->add('icons', null, array('label' => 'Блок иконок с необходимыми условиями выполнения'))
                ->add('description', null, array('label' => 'Текст с коротким описанием задания'));
    }

    /**
     * Поля, по которым производится поиск в списке записей
     *
     * @param \Sonata\AdminBundle\Datagrid\DatagridMapper $datagridMapper
     * @return void
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
                ->add('description', null, array('label' => 'Текст с коротким описанием задания'));
    }

    /**
     * Конфигурация левого меню при отображении и редатировании записи
     *
     * @param \Knp\Menu\ItemInterface $menu
     * @param $action
     * @param null|\Sonata\AdminBundle\Admin\AdminInterface $childAdmin
     * @return void
     */
    protected function configureSideMenu(MenuItemInterface $menu, $action, AdminInterface $childAdmin = null)
    {
        if ($action == 'edit' || $action == 'show')
        $menu->addChild(
            $action == 'edit' ? 'Просмотр задания' : 'Редактирование задания',
            array('uri' => $this->generateUrl(
                $action == 'edit' ? 'show' : 'edit', array('id' => $this->getRequest()->get('id'))))
        );
    }
}