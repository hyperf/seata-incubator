<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace Hyperf\Seata\SqlParser\Antlr\MySql\Parser\Context;

    use Antlr\Antlr4\Runtime\Tree\ParseTreeListener;
    use Antlr\Antlr4\Runtime\Tree\TerminalNode;
    use Hyperf\Seata\SqlParser\Antlr\MySql\Listener\MySqlParserListener;
    use Hyperf\Seata\SqlParser\Antlr\MySql\Parser\MySqlParser;

    class AlterByChangeColumnContext extends AlterSpecificationContext
    {
        /**
         * @var null|UidContext
         */
        public $oldColumn;

        /**
         * @var null|UidContext
         */
        public $newColumn;

        /**
         * @var null|UidContext
         */
        public $afterColumn;

        public function __construct(AlterSpecificationContext $context)
        {
            parent::__construct($context);

            $this->copyFrom($context);
        }

        public function CHANGE(): ?TerminalNode
        {
            return $this->getToken(MySqlParser::CHANGE, 0);
        }

        public function columnDefinition(): ?ColumnDefinitionContext
        {
            return $this->getTypedRuleContext(ColumnDefinitionContext::class, 0);
        }

        /**
         * @return null|array<UidContext>|UidContext
         */
        public function uid(?int $index = null)
        {
            if ($index === null) {
                return $this->getTypedRuleContexts(UidContext::class);
            }

            return $this->getTypedRuleContext(UidContext::class, $index);
        }

        public function COLUMN(): ?TerminalNode
        {
            return $this->getToken(MySqlParser::COLUMN, 0);
        }

        public function FIRST(): ?TerminalNode
        {
            return $this->getToken(MySqlParser::FIRST, 0);
        }

        public function AFTER(): ?TerminalNode
        {
            return $this->getToken(MySqlParser::AFTER, 0);
        }

        public function enterRule(ParseTreeListener $listener): void
        {
            if ($listener instanceof MySqlParserListener) {
                $listener->enterAlterByChangeColumn($this);
            }
        }

        public function exitRule(ParseTreeListener $listener): void
        {
            if ($listener instanceof MySqlParserListener) {
                $listener->exitAlterByChangeColumn($this);
            }
        }
    }
