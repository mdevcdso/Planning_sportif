<?php
$menuItems = array(
    array(
        'name' => 'Gestion des matchs',
        'subItems' => array(
            'Ajouter',
            'Modifier',
            'Supprimer'
        )
    ),
    array(
        'name' => 'Matchs favoris',
        'subItems' => array()
    ),
    array(
        'name' => 'Notifications',
        'subItems' => array()
    ),
    array(
        'name' => 'Design Planning',
        'subItems' => array()
    ),
    array(
        'name' => 'Paramètres du compte',
        'subItems' => array()
    )
);
?>

<ul class="menu">
    <?php foreach ($menuItems as $menuItem): ?>
        <li class="menu-item" data-menu="<?php echo $menuItem['name']; ?>">
            <?php echo $menuItem['name']; ?>
            <?php if (!empty($menuItem['subItems'])): ?>
                <ul class="sub-items" data-submenu="<?php echo $menuItem['name']; ?>">
                    <?php foreach ($menuItem['subItems'] as $subItem): ?>
                        <li class="sub-item"><?php echo $subItem; ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </li>
    <?php endforeach; ?>
</ul>
