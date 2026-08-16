<?php
$data = $data ?? [];
$fournisseurs = $data["fournisseurs"];
$clients = $data["clients"];
$produits = $data["produits"];
$stats = $data["stats"];
?>
<div>
    <!-- Catalog Stats Grid -->
    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; margin-bottom: 24px;">
        <div class="panel-card" style="padding: 16px; display: flex; align-items: center; justify-content: space-between; border-left: 4px solid var(--success);">
            <div>
                <span style="font-size: 10px; color: var(--text-muted); text-transform: uppercase; font-weight: 700;">Valeur Totale Stock</span>
                <div style="font-size: 18px; font-weight: 800; color: white; margin-top: 4px;"><?= $stats["valeur_stock"] ?>  F</div>
            </div>
            <span style="font-size: 24px;">📦</span>
        </div>
        <div class="panel-card" style="padding: 16px; display: flex; align-items: center; justify-content: space-between; border-left: 4px solid var(--accent);">
            <div>
                <span style="font-size: 10px; color: var(--text-muted); text-transform: uppercase; font-weight: 700;">Articles au Catalogue</span>
                <div style="font-size: 18px; font-weight: 800; color: white; margin-top: 4px;"><?= $stats["nombre_produits"] ?> références</div>
            </div>
            <span style="font-size: 24px;">🏷️</span>
        </div>
        <div class="panel-card" style="padding: 16px; display: flex; align-items: center; justify-content: space-between; border-left: 4px solid var(--warning);">
            <div>
                <span style="font-size: 10px; color: var(--text-muted); text-transform: uppercase; font-weight: 700;">Clients Enregistrés</span>
                <div style="font-size: 18px; font-weight: 800; color: white; margin-top: 4px;"><?= $stats["nombre_clients"] ?>  clients</div>
            </div>
            <span style="font-size: 24px;">👥</span>
        </div>
    </div>

    <!-- Tab Navigation for Catalog -->
    <div style="display: flex; gap: 8px; margin-bottom: 24px; border-bottom: 1px solid var(--border-color); padding-bottom: 12px;">
        <button id="catalog-tab-btn-products" class="nav-item active" style="padding: 10px 20px; font-size: 12px; text-transform: uppercase; font-weight: 700;" onclick="switchCatalogTab('products')">🏷️ Gestion Produits</button>
        <button id="catalog-tab-btn-clients" class="nav-item" style="padding: 10px 20px; font-size: 12px; text-transform: uppercase; font-weight: 700;" onclick="switchCatalogTab('clients')">👥 Gestion Clients</button>
        <button id="catalog-tab-btn-suppliers" class="nav-item" style="padding: 10px 20px; font-size: 12px; text-transform: uppercase; font-weight: 700;" onclick="switchCatalogTab('suppliers')">🤝 Gestion Fournisseurs</button>
    </div>

    <!-- TAB 1: Gestion Produits -->
    <div id="catalog-panel-products" style="display: grid; grid-template-columns: 600px 1fr; gap: 32px; align-items: start;">
        <!-- Left: Form -->
        <div class="panel-card" style="margin-bottom: 0;">
            <div class="panel-title">Ajouter un Article</div>
            <form method="POST" action="http://localhost:8000/tiers/addProduit">
                <input type="hidden" name="action" value="add_product">
                <div class="form-group">
                    <label for="libelle">Nom de l'Article</label>
                    <input type="text" name="libelle" class="form-control" placeholder="Ex: Carton de savon" required>
                </div>
                <div class="form-group">
                    <label for="prix_unitaire">Prix de Vente (FCFA)</label>
                    <input type="number" name="prix_unitaire" class="form-control" placeholder="Ex: 12000" min="0" required>
                </div>
                <div class="form-group">
                    <label for="stock_actuel">Stock Initial</label>
                    <input type="number" name="stock_actuel" class="form-control" placeholder="Ex: 50" min="0" required>
                </div>
                <div class="form-group">
                    <label for="seuil_alerte_rupture">Seuil d'Alerte de Rupture</label>
                    <input type="number" name="seuil_alerte_rupture" class="form-control" value="5" min="0" required>
                </div>
                <button type="submit" class="btn-submit btn-success" style="width: 100%;">Enregistrer le Produit (DML)</button>
            </form>
        </div>

        <!-- Right: Product list -->
        <div class="panel-card" style="margin-bottom: 0;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                <label style="font-size: 13px; font-weight: 700; color: var(--accent); text-transform: uppercase;">Catalogue Courant</label>
                <input type="text" id="catalog-search" class="search-control" placeholder="Filtrer les produits..." onkeyup="filterProductsTable()">
            </div>
            <table class="debt-table" id="catalog-main-table">
                <thead>
                    <tr>
                        <th>Article</th>
                        <th>Prix de Vente</th>
                        <th>Stock</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($produits as $produit): ?>
                        <tr data-product-name="<?= $produit->getLibelle() ?>">
                            <td style="font-weight: 700;"><?= $produit->getLibelle() ?></td>
                            <td><?= $produit->getPrixUnitaire() ?> F</td>
                            <td style="font-weight: 700; color: var(<?= $produit->etatStockEnCouleur() ?>);">
                                <?= $produit->getStockActuel() ?> </td>
                        </tr>
                    <?php endforeach ?>

                </tbody>
            </table>
        </div>
    </div>

    <!-- TAB 2: Gestion Clients -->
    <div id="catalog-panel-clients" style="display: none; grid-template-columns: 600px 1fr; gap: 32px; align-items: start;">
        <!-- Left: Form -->
        <div class="panel-card" style="margin-bottom: 0;">
            <div class="panel-title">Enregistrer un Client</div>
            <form method="POST" action="http://localhost:8000/tiers/addClient">
                <div class="form-group" style="margin-bottom: 12px;">
                    <label for="nom">Nom complet</label>
                    <input type="text" name="nom" class="form-control" placeholder="Ex: Abdou Ndiaye" required>
                </div>
                <div class="form-group" style="margin-bottom: 12px;">
                    <label for="telephone">Téléphone</label>
                    <input type="text" name="telephone" class="form-control" placeholder="Ex: 776543210" required>
                </div>
                <div class="form-group" style="margin-bottom: 12px;">
                    <label for="adresse">Adresse</label>
                    <input type="text" name="adresse" class="form-control" placeholder="Ex: Mermoz, Dakar" required>
                </div>
                <div class="form-group" style="margin-bottom: 12px;">
                    <label for="limite_credit">Limite de Crédit (FCFA)</label>
                    <input type="number" name="limite_credit" class="form-control" value="150000" min="0" required>
                </div>
                <button type="submit" class="btn-submit" style="width: 100%;">Créer le Compte Client (DML)</button>
            </form>
        </div>

        <!-- Right: Clients list -->
        <div class="panel-card" style="margin-bottom: 0;">
            <label style="font-size: 13px; font-weight: 700; color: var(--accent); display: block; margin-bottom: 12px; text-transform: uppercase;">Répertoire Clients</label>
            <table class="debt-table" id="clients-main-table" style="font-size: 12px;">
                <thead>
                    <tr>
                        <th>Client</th>
                        <th>Téléphone</th>
                        <th>Limite de Crédit</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($clients as $client): ?>
                        <tr>
                            <td style="font-weight: 700;"><?= $client->getNom() ?></td>
                            <td><?= $client->getTelephone() ?></td>
                            <td style="font-weight: 700; color: var(--accent);"><?= $client->getLimiteCredit() ?> F</td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- TAB 3: Gestion Fournisseurs -->
    <div id="catalog-panel-suppliers" style="display: none; grid-template-columns: 600px 1fr; gap: 32px; align-items: start;">
        <!-- Left: Form -->
        <div class="panel-card" style="margin-bottom: 0;">
            <div class="panel-title">Enregistrer un Fournisseur</div>
            <form method="POST" action="http://localhost:8000/tiers/addFournisseur">
                <div class="form-group">
                    <label for="nom">Nom de l'Entreprise</label>
                    <input type="text" name="nom" class="form-control" placeholder="Ex: Comptoir Céréalier Sénégalais" required>
                </div>
                <div class="form-group">
                    <label for="telephone">Téléphone</label>
                    <input type="text" name="telephone" class="form-control" placeholder="Ex: 338245678" required>
                </div>
                <div class="form-group">
                    <label for="adresse">Adresse / Dépôt</label>
                    <input type="text" name="adresse" class="form-control" placeholder="Ex: Hangar 4, Port de Dakar" required>
                </div>
                <button type="submit" class="btn-submit" style="width: 100%;">Créer le Fournisseur (DML)</button>
            </form>
        </div>

        <!-- Right: Suppliers list -->
        <div class="panel-card" style="margin-bottom: 0;">
            <label style="font-size: 13px; font-weight: 700; color: var(--accent); display: block; margin-bottom: 12px; text-transform: uppercase;">Répertoire Fournisseurs</label>
            <table class="debt-table" id="suppliers-main-table" style="font-size: 12px;">
                <thead>
                    <tr>
                        <th>Entreprise</th>
                        <th>Téléphone</th>
                        <th>Adresse</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($fournisseurs as $fournisseur): ?>
                        <tr>
                            <td style="font-weight: 700;"><?= $fournisseur->getNom() ?></td>
                            <td><?= $fournisseur->getTelephone() ?></td>
                            <td><?= $fournisseur->getAdresse() ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>