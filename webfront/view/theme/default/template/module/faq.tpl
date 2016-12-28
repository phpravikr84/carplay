<?php echo $header; $s = 1; ?>
<div class="container">
  <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
  </ul>
  <div class="row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
    
          <div class="row">
              <div class="col-sm-12">
              <?php if(!empty($sections)):?>
                  <div class="faq-area">
                  <?php $i = 0; ?>
                  <?php foreach($sections as $section):?>
                      <?php if(!empty($section['items'])):?>
                          <div class="faq-section">
                               <?php if(!$section['hidden']):?>
                               <h2 class="section-title"><?php echo $section['title']; ?></h2>
                               <?php $s = 1; ?>
                               <?php endif; ?>
                               
                               <div id="accordion">
                                    <?php foreach($section['items'] as $item):?>
                                        <?php if(trim($item['question']) == '') continue; ?>
                                        <div class="panel panel-faq">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <?php if($settings['collapse']):?>
                                                    <a data-toggle="collapse" data-parent="#questions" href="#answer-<?php echo $i; ?>" aria-expanded="false" class="collapsed">
                                                        <?php echo  $s . '. ' . $item['question']; ?>
                                                    </a>
                                                    <?php else:?>
                                                    <span><?php echo $s . '. ' . $item['question']; ?></span>
                                                    <?php endif; ?>
                                                </h4>
                                            </div>
                                            <div id="answer-<?php echo $i; ?>" <?php if($settings['collapse']):?> class="panel-collapse collapse" aria-expanded="false" <?php endif; ?>>
                                                <div class="panel-body">
                                                    <?php echo $item['answer']; ?>
                                                </div>
                                            </div>
                                        </div>
                                         <?php $i++; $s++; ?>
                                    <?php endforeach; ?>
                               </div>
                          </div>
                      <?php endif; ?>
                  <?php endforeach; ?>
                  </div>
              <?php endif; ?>    
              </div>
          </div>

      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<?php echo $footer; ?>