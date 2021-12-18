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

use Antlr\Antlr4\Runtime\ParserRuleContext;
    use Antlr\Antlr4\Runtime\Tree\ParseTreeListener;
    use Antlr\Antlr4\Runtime\Tree\TerminalNode;
    use Hyperf\Seata\SqlParser\Antlr\MySql\Listener\MySqlParserListener;
    use Hyperf\Seata\SqlParser\Antlr\MySql\Parser\MySqlParser;

    class RenameTableContext extends ParserRuleContext
    {
        public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
        {
            parent::__construct($parent, $invokingState);
        }

        public function getRuleIndex(): int
        {
            return MySqlParser::RULE_renameTable;
        }

        public function RENAME(): ?TerminalNode
        {
            return $this->getToken(MySqlParser::RENAME, 0);
        }

        public function TABLE(): ?TerminalNode
        {
            return $this->getToken(MySqlParser::TABLE, 0);
        }

        /**
         * @return null|array<RenameTableClauseContext>|RenameTableClauseContext
         */
        public function renameTableClause(?int $index = null)
        {
            if ($index === null) {
                return $this->getTypedRuleContexts(RenameTableClauseContext::class);
            }

            return $this->getTypedRuleContext(RenameTableClauseContext::class, $index);
        }

        /**
         * @return null|array<TerminalNode>|TerminalNode
         */
        public function COMMA(?int $index = null)
        {
            if ($index === null) {
                return $this->getTokens(MySqlParser::COMMA);
            }

            return $this->getToken(MySqlParser::COMMA, $index);
        }

        public function enterRule(ParseTreeListener $listener): void
        {
            if ($listener instanceof MySqlParserListener) {
                $listener->enterRenameTable($this);
            }
        }

        public function exitRule(ParseTreeListener $listener): void
        {
            if ($listener instanceof MySqlParserListener) {
                $listener->exitRenameTable($this);
            }
        }
    }
