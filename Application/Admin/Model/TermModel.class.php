<?php
/**
 * Created by PhpStorm.
 * User: apacal
 * Date: 14-12-21
 * Time: 下午5:36
 */

/**
 * Term Model manage term, include term, term_taxonomy, term_relationships table
 */
namespace Admin\Model;


use Think\Model;

class TermModel {


    /**
     * @param $taxonomy
     * @return array|null
     */
    public function getTermsByTaxonomy($taxonomy) {
        $taxonomyModel = new Model('TermTaxonomy');
        $map = array(
            'taxonomy' => $taxonomy,
        );
        $taxonomyData = $taxonomyModel->where($map)->select();
        if(is_array($taxonomyData)) {
            $termModel = new Model('Terms');
            $termIds = array();
            foreach ($taxonomyData as $val) {
                $termIds[] = $val['term_id'];
            }
            $ret = $termModel->where(array('term_id' => array('in', $termIds)))->select();
            return $ret;
        }
        return null;

    }
    /**
     * @param $taxonomy | string
     * @param $objectId | int
     * @return array|null
     */
    public function getTermsByObjectIdAndTaxonomy($taxonomy, $objectId) {
        $relationships = new Model('TermRelationships');
        $relationshipsData = $relationships->where(array('object_id' => $objectId))->select();

        if (is_array($relationshipsData)) {
            $taxonomyModel = new Model('TermTaxonomy');
            $taxonomyIds = array();
            foreach($relationshipsData as $val) {
                $taxonomyIds[] = $val['term_taxonomy_id'];
            }
            $map = array(
                'taxonomy' => $taxonomy,
                'term_taxonomy_id' => array('in', $taxonomyIds),
            );
            $taxonomyData = $taxonomyModel->where($map)->select();

            if(is_array($taxonomyData)) {
                $termModel = new Model('Terms');
                $termIds = array();
                foreach ($taxonomyData as $val) {
                    $termIds[] = $val['term_id'];
                }
                $ret = $termModel->where(array('term_id' => array('in', $termIds)))->select();
                return $ret;
            }

        }
        return null;
    }
    /**
     * @param $controller | str
     * @param $objectId | int
     * @param $terms | array
     */
    public function saveTerms($controller, $objectId, $terms) {
        if (empty($terms) || !is_array($terms)) {
            return false;
        }

        $termsIdArray = $this->getTermIdArray($terms);
        $taxonomyIdArray = $this->getTaxonomyIdArrayByTermIdArray($controller, $termsIdArray);

        $this->saveTermRelationships($objectId, $taxonomyIdArray);




    }

    /**
     * @param $objectId | int
     * @param $taxonomyIdArray | array
     */
    private function saveTermRelationships($objectId, $taxonomyIdArray) {
        $relationships = new Model('TermRelationships');
        if (!is_array($taxonomyIdArray)) {
            $relationships->rollback();
        }
        foreach($taxonomyIdArray as $val) {
            $data = array(
                'object_id' => $objectId,
                'term_taxonomy_id' => $val,
            );
            $relationships->add($data);
        }
        $relationships->commit();
    }

    /**
     * @param $taxonomy | string
     * @param $terms | array
     * @return array
     */
    private function getTaxonomyIdArrayByTermIdArray($taxonomy, $terms) {
        $taxonomyModel = new Model('TermTaxonomy');
        $data = array();
        foreach($terms as $val) {
            $termTaxonomy = $taxonomyModel->where(array('taxonomy' => $taxonomy,'term_id' => $val))->getField('term_taxonomy_id');
            if (null === $termTaxonomy) {
                $termTaxonomy = $taxonomyModel->add(array('term_id' => $val, 'taxonomy' => $taxonomy));
                $data[] = $termTaxonomy;
            } else {
                $taxonomyModel->where(array('taxonomy'=>$taxonomy, 'term_id'=>$val))->setInc('count');
                $data[] = $termTaxonomy['term_taxonomy_id'];
            }

        }
        return $data;

    }

    /**
     * @param $terms | array
     * @return array
     */
    private function getTermIdArray($terms) {
        $termModel = new Model('Terms');
        $termModel->startTrans();
        $data = array();
        foreach ($terms as $val) {
            $term = $termModel->where(array('slug'=>$val))->getField('term_id');
            if ($term == null) {
                $term = $termModel->add(array('name' => $val, 'slug' => $val));
                $data[] = $term;
            } else {
                $data[] = $term['term_id'];
            }
        }
        return $data;


    }


} 