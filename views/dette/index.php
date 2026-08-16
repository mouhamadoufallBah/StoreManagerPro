<?php
$data = $data ?? [];
$dettes = $data['dettes'];
$stats = $data['stats'];
?>
<div>
    <!-- Debts Stats Grid -->
    <!-- Debts Stats Grid -->
    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; margin-bottom: 24px;">
        <div class="panel-card" style="padding: 16px; display: flex; align-items: center; justify-content: space-between; border-left: 4px solid var(--danger);">
            <div>
                <span style="font-size: 10px; color: var(--text-muted); text-transform: uppercase; font-weight: 700;">Créances Actives</span>
                <div style="font-size: 18px; font-weight: 800; color: white; margin-top: 4px;"><?= $stats['creances_actives'] ?? 0 ?> F</div>
            </div>
            <span style="font-size: 24px;">💸</span>
        </div>
        <div class="panel-card" style="padding: 16px; display: flex; align-items: center; justify-content: space-between; border-left: 4px solid var(--warning);">
            <div>
                <span style="font-size: 10px; color: var(--text-muted); text-transform: uppercase; font-weight: 700;">Clients Débiteurs</span>
                <div style="font-size: 18px; font-weight: 800; color: white; margin-top: 4px;"><?= $stats['clients_debiteurs'] ?? 0 ?> clients</div>
            </div>
            <span style="font-size: 24px;">👥</span>
        </div>
        <div class="panel-card" style="padding: 16px; display: flex; align-items: center; justify-content: space-between; border-left: 4px solid var(--success);">
            <div>
                <span style="font-size: 10px; color: var(--text-muted); text-transform: uppercase; font-weight: 700;">Total Recouvrements</span>
                <div style="font-size: 18px; font-weight: 800; color: white; margin-top: 4px;"><?= $stats['total_recouvrements'] ?? 0 ?> F</div>
            </div>
            <span style="font-size: 24px;">📈</span>
        </div>
    </div>

    <div style="display: block;">
        <!-- Full width: Debt registry logs -->
        <div class="panel-card" style="margin-bottom: 0;">
            <div class="panel-title">
                <span>Registre des Dettes Actives</span>
                <input type="text" id="debt-search" class="search-control" placeholder="Rechercher un client..." onkeyup="filterDebtsTable()">
            </div>
            <table class="debt-table" id="debts-main-table">
                <thead>
                    <tr>
                        <th>ID Dette</th>
                        <th>Date Création</th>
                        <th>Client</th>
                        <th>Montant Initial</th>
                        <th>Montant Payé</th>
                        <th>Reste Dû</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($dettes)): ?>
                        <tr>
                            <td colspan="8" style="text-align: center; color: var(--text-muted); padding: 20px;">Aucune dette enregistrée.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($dettes as $dette): ?>
                            <?php
                            $montantPayeTotal = 0;
                            foreach ($dette['paiements'] as $p) {
                                $montantPayeTotal += (float)$p['montantPaye'];
                            }
                            $resteAPayer = (float)$dette['resteAPayer'];
                            $montantInitial = (float)$dette['montantInitial'];
                            $isSoldee = (bool)$dette['estSoldee'];
                            ?>
                            <tr id="debt-row-<?= $dette['id'] ?>" data-client-name="<?= $dette['client']['nom'] . ' ' . $dette['client']['telephone'] ?>" style="transition: all 0.2s;">
                                <td style="font-weight: 700; color: var(--text-muted);">
                                    #DT-<?= $dette['id'] ?> <span style="font-size: 10px; color: var(--text-muted); display: block; font-weight: normal; margin-top: 2px;">#CMD-<?= $dette['vente_id'] ?></span>
                                </td>

                                <td style="font-size: 12px;"><?= $dette['dateEcheance'] ?? 'N/A' ?></td>

                                <td style="font-weight: 700;">
                                    <?= $dette['client']['nom'] ?>
                                    <div style="font-size:11px; color:var(--text-muted); font-weight:normal;">Tél : <?= $dette['client']['telephone'] ?></div>
                                </td>

                                <td style="font-weight: 700; color: var(--text-main);"><?= number_format($montantInitial, 0, ',', ' ') ?> F</td>
                                <td style="font-weight: 700; color: var(--success);"><?= number_format($montantPayeTotal, 0, ',', ' ') ?> F</td>
                                <td style="color: var(--danger); font-weight: 800;"><?= number_format($resteAPayer, 0, ',', ' ') ?> F</td>

                                <td>
                                    <?php if ($isSoldee): ?>
                                        <span class="badge" style="background: rgba(16, 185, 129, 0.12); color: var(--success); border: 1px solid rgba(16, 185, 129, 0.3);">SOLDEE</span>
                                    <?php else: ?>
                                        <span class="badge badge-danger">NON SOLDEE</span>
                                    <?php endif; ?>
                                </td>

                                <td style="display: flex; gap: 6px;">
                                    <button type="button" class="btn-quick-action" onclick="toggleDetails('debt-lines-<?= $dette['id'] ?>')">Articles</button>
                                    <button type="button" class="btn-quick-action" style="border-color: var(--accent); color: var(--accent);" onclick="toggleDetails('debt-details-<?= $dette['id'] ?>')">💳 Paiements</button>
                                    <?php if (!$isSoldee): ?>
                                        <button type="button" class="btn-quick-action" style="border-color: var(--warning); color: var(--warning);" onclick="toggleDetails('debt-repay-drawer-<?= $dette['id'] ?>')">Rembourser</button>
                                    <?php endif; ?>
                                </td>
                            </tr>

                            <tr>
                                <td colspan="8" style="padding: 0; border: none;">

                                    <div class="details-drawer" id="debt-details-<?= $dette['id'] ?>">
                                        <div style="font-weight: 700; font-size: 12px; color: var(--accent); margin-bottom: 8px;">Paiements enregistrés :</div>
                                        <table class="debt-table" style="font-size: 11px;">
                                            <thead>
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Versement</th>
                                                    <th>Mode</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (empty($dette['paiements'])): ?>
                                                    <tr>
                                                        <td colspan="3" style="text-align: center; color: var(--text-muted);">Aucun acompte versé.</td>
                                                    </tr>
                                                <?php else: ?>
                                                    <?php foreach ($dette['paiements'] as $p): ?>
                                                        <tr>
                                                            <td><?= $p['datePaiement'] ?></td>
                                                            <td style="font-weight: 700; color: var(--success);"><?= $p['montantPaye'] ?> F</td>
                                                            <td><?= $p['methodePaiement'] ?></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="details-drawer" id="debt-lines-<?= $dette['id'] ?>">
                                        <div style="font-weight: 700; font-size: 12px; color: var(--accent); margin-bottom: 8px;">Articles de la Vente à Crédit :</div>
                                        <table class="debt-table" style="font-size: 11px;">
                                            <thead>
                                                <tr>
                                                    <th>Produit</th>
                                                    <th>Qté</th>
                                                    <th>P.U.</th>
                                                    <th>Sous-total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (empty($dette['produits'])): ?>
                                                    <tr>
                                                        <td colspan="4" style="text-align: center; color: var(--text-muted);">Aucun article trouvé.</td>
                                                    </tr>
                                                <?php else: ?>
                                                    <?php foreach ($dette['produits'] as $prod): ?>
                                                        <?php $sousTotal = (float)$prod['quantite'] * (float)$prod['prixUnitaire']; ?>
                                                        <tr>
                                                            <td><?= $prod['libelle'] ?></td>
                                                            <td><?= $prod['quantite'] ?></td>
                                                            <td><?= $prod['prixUnitaire'] ?> F</td>
                                                            <td style="font-weight: 700; color: var(--accent);"><?= $sousTotal ?> F</td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>

                                    <?php if (!$isSoldee): ?>
                                        <div class="details-drawer" id="debt-repay-drawer-<?= $dette['id'] ?>" style="border: 1px solid rgba(45, 212, 191, 0.25); background: linear-gradient(180deg, rgba(11, 15, 25, 0.95) 0%, rgba(11, 15, 25, 0.98) 100%); border-radius: 14px; padding: 18px 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.4); max-width: 850px; margin: 12px 0;">

                                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 14px; border-bottom: 1px dashed var(--border-color); padding-bottom: 10px;">
                                                <div style="display: flex; align-items: center; gap: 8px;">
                                                    <span style="font-size: 16px;">💳</span>
                                                    <span style="font-weight: 800; font-size: 13px; color: var(--text-main);">
                                                        Nouveau Remboursement — <span style="color: var(--accent);"><?= $dette['client']['nom'] ?></span>
                                                    </span>
                                                </div>
                                                <div style="background: rgba(244, 63, 94, 0.12); border: 1px solid rgba(244, 63, 94, 0.3); padding: 4px 12px; border-radius: 20px; font-size: 11px; font-weight: 800; color: var(--danger);">
                                                    Reste dû : <?= $resteAPayer ?> FCFA
                                                </div>
                                            </div>

                                            <div style="display: flex; gap: 8px; align-items: center; margin-bottom: 16px;">
                                                <span style="font-size: 10px; text-transform: uppercase; color: var(--text-muted); font-weight: 700;">Raccourcis :</span>
                                                <button type="button" onclick="setRepayAmount(<?= $dette['id'] ?>, <?= $resteAPayer ?>)" style="background: rgba(45, 212, 191, 0.1); border: 1px solid var(--accent); color: var(--accent); font-size: 10px; font-weight: 700; padding: 4px 10px; border-radius: 6px; cursor: pointer;">Tout solder (<?= number_format($resteAPayer, 0, ',', ' ') ?> F)</button>
                                                <button type="button" onclick="setRepayAmount(<?= $dette['id'] ?>, <?= $resteAPayer / 2 ?>)" style="background: rgba(255, 255, 255, 0.04); border: 1px solid var(--border-color); color: var(--text-main); font-size: 10px; font-weight: 700; padding: 4px 10px; border-radius: 6px; cursor: pointer;">50% (<?= number_format($resteAPayer / 2, 0, ',', ' ') ?> F)</button>
                                            </div>

                                            <form method="POST" action="/dette/remboursement" style="display: flex; gap: 16px; align-items: flex-end; flex-wrap: wrap;">
                                                <input type="hidden" name="dette_id" value="<?= $dette['id'] ?>">

                                                <div style="flex: 1; min-width: 200px;">
                                                    <label style="font-size: 10px; color: var(--text-muted); display: block; margin-bottom: 6px; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 700;">Montant du Versement (FCFA)</label>
                                                    <div style="position: relative;">
                                                        <input type="number" name="montant_paye" id="repay-input-<?= $dette['id'] ?>" class="form-control" max="<?= $resteAPayer ?>" value="<?= $resteAPayer ?>" min="1" step="any" required style="font-size: 13px; font-weight: 700; padding: 10px 12px; background: #0b0f19; border: 1px solid var(--border-color); color: white; width: 100%;">
                                                    </div>
                                                </div>

                                                <div style="flex: 1; min-width: 200px;">
                                                    <label style="font-size: 10px; color: var(--text-muted); display: block; margin-bottom: 6px; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 700;">Canal de Paiement</label>
                                                    <select name="methode_paiement" class="form-control" style="font-size: 13px; font-weight: 600; padding: 10px 12px; background: #0b0f19; border: 1px solid var(--border-color); color: white; width: 100%;" required>
                                                        <option value="Orange Money">🟠 Orange Money</option>
                                                        <option value="Wave">🌊 Wave</option>
                                                        <option value="Espèces">💵 Espèces (Cash)</option>
                                                        <option value="Virement">🏦 Virement Bceao</option>
                                                    </select>
                                                </div>

                                                <div>
                                                    <button type="submit" class="btn-submit btn-success" style="padding: 11px 24px; font-size: 12px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px; display: flex; align-items: center; gap: 8px; border-radius: 10px; height: 42px;">
                                                        ✓ Enregistrer le Remboursement
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    <?php endif; ?>

                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>