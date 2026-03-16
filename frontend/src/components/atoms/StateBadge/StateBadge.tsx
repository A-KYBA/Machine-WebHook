import type { MachineState } from '../../../types/machine';
import styles from './StateBadge.module.css';

interface StateBadgeProps {
  state: MachineState;
}

function StateBadge({ state }: StateBadgeProps) {
  return (
    <span>
      Status: <span className={`${styles.badge} ${styles[state.toLowerCase()]}`}>{state}</span>
    </span>
  );
}

export default StateBadge;
