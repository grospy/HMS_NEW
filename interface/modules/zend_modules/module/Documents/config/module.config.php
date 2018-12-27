<?php


return array(
    'controllers' => array(
        'invokables'  => array(
            'Documents'   => 'Documents\Controller\DocumentsController',
        ),
    ),

    'router' => array(
        'routes' => array(
            'documents' => array(
                'type'    => 'segment',
                'options' => array(
                        'route'    => '/documents[/:controller][/:action][/:id][/:download][/:doencryption][/:key]',
                        'constraints' => array(
                            'action'        => '[a-zA-Z][a-zA-Z0-9_-]*',
                            'id'            => '[0-9]+',
              'download'      => '[0-1]+',
              'doencryption'  => '[0-1]+',
              'key'           => '[a-zA-Z][a-zA-Z0-9_-]*',
                        ),
                        'defaults' => array(
                            'controller' => 'Documents',
                            'action'     => 'list',
                        ),
                ),
            ),
        ),
  ),

    'view_manager' => array(
        'template_path_stack' => array(
            'documents' => __DIR__ . '/../view/',
        ),
        'template_map' => array(
            'documents/layout' => __DIR__ . '/../view/layout/layout.phtml',
        ),
        'strategies' => array(
            'ViewJsonStrategy',
            'ViewFeedStrategy',
        ),
    ),
);
